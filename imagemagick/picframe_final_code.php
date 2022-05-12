<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Class for append frames and canvas using imageMagic libary.
 * 1. Append frame in image
 * 2. 3d canvas image  
 */
class imageMagickFrameEdge
{
	const PT_PRINT_ONLY = "PT01";
	const PT_WRAPPED_CANVAS = "PT02";
	const PT_PRINT_FRAME= "PT03";

	/**
	 * Append frame and canvas to the image and store 
	 * 
	 * @param string $filePath
	 * @param string $overlayTop
	 * @param string $overlayBottom
	 * @param array $options
	 * 
	 * @return json
	 */
	public function addFrame($options)
	{
		try {			
			if ($options['type_code'] === SELF::PT_PRINT_ONLY) {
				throw new \Exception("No need to modify anything for painting.");
			}

			$filePath = $options['filePath'];

			// Get original file geometry array
			[$fileWidth, $fileHeight] = $this->getImageGeometry($filePath);

			// Generate new file name and full path to store image
			[$newFileName, $newFilePath] = $this->newFilenameAndPath($options);

			$output = "";

			switch ($options['type_code']) {
				case SELF::PT_PRINT_FRAME :						
					$frameImage = $options['frame_image'];

					// Get original file geometry array
					[$overlayWidth, $overlayHeight] = $this->getImageGeometry($frameImage);

					if ($overlayWidth < $overlayHeight) {
						$overlayHeight = $overlayWidth;
					}

					$matteSize = isset($options['mat_width']) ? $options['mat_width'] : 0;
					$matteColor = isset($options['mat_color_code']) ? $options['mat_color_code'] : "#ffffff";
					$matteSize = $matteSize*3;

					$matTopBottomMargin = 1;
					$matLeftRightMargin = 1;
					($fileWidth >= $fileHeight) ? $matTopBottomMargin = 1.5 : $matLeftRightMargin = 1.5;
		

					exec('magick convert -verbose "' . $filePath . '" -write mpr:image +delete "' . $frameImage . '" -write mpr:edge_top +delete "' . $frameImage . '" -rotate 0 -write mpr:edge_btm +delete mpr:image -alpha set  -bordercolor ' . $matteColor . ' -border ' . ($matteSize*$matLeftRightMargin) . '%x' . ($matteSize*$matTopBottomMargin ) . '%  -compose Dst -frame ' . ($overlayHeight / 2) . 'x' . ($overlayHeight / 2) . '+' . ($overlayHeight / 2) . '  -compose over -tile mpr:edge_btm -transverse -draw "color 1,0 floodfill" -transpose  -draw "color 1,0 floodfill" -tile mpr:edge_top -transverse -draw "color 1,0 floodfill" -transpose  -draw "color 1,0 floodfill" mpr:image -gravity center -composite "' . $newFilePath . '"', $output);

					break;

					// print_r('qq');
					// die();

					exec('magick convert -verbose "' . $filePath . '"  -bordercolor ' . $matteColor . ' -border ' . ($matteSize) . '%x' . ($matteSize / 1) . '% -write mpr:image +delete "' . $frameImage . '" -write mpr:edge_top +delete "' . $frameImage . '" -rotate 180 -write mpr:edge_btm +delete mpr:image -alpha set -bordercolor none -compose Dst -frame ' . ($overlayHeight / 2) . 'x' . ($overlayHeight / 2) . '+' . ($overlayHeight / 2) . '  -compose over -tile mpr:edge_btm -transverse -draw "color 1,0 floodfill" -transpose  -draw "color 1,0 floodfill" -tile mpr:edge_top -transverse -draw "color 1,0 floodfill" -transpose  -draw "color 1,0 floodfill" mpr:image -gravity center -composite "' . $newFilePath . '"', $output);

					break;

				case SELF::PT_WRAPPED_CANVAS:			
					$canvasColorCode = isset($options['canvas_color_code']) ? $options['canvas_color_code'] : '#ffffff';

					$tempPartInfo = pathinfo($filePath);
					$tempFileName = $tempPartInfo['filename'];
					$tempFileExtension = $tempPartInfo['filename'];

					// Temp file name remove when process finish
					$tempPng = $tempFileName."temp.png";
					$highlightsMiff = $tempFileName."highlights.miff";
					$centerMiff = $tempFileName."center.miff";
					$topMiff = $tempFileName."top.miff";
					$rightMiff = $tempFileName."right.miff";
					$rightEdgeMiff = $tempFileName."right_edge.miff";
					$topEdgeMiff = $tempFileName."top_edge.miff";

					// Resize to a png to stop quality loss
					exec("magick convert -verbose  $filePath -thumbnail 500x500 $tempPng");

					$size = getimagesize($tempPng);					
					$edge = $size[0]*.05;					
					$width = $size[0] - ( $edge * 4 );
					$height = $size[1] - ( $edge * 4 );					
					$shrink = round(( $edge * 0.6 ), 4);					
					$angle = 45;										
					$radian = ( $angle * Pi() ) / 180;
					$alpha = round((tan($radian) * $shrink), 4);					
					$short_side = round( ($height - $alpha ), 4);					
					$top_long = round($width + $shrink, 4);

					// Create the highlights image
					$width_short = $width-1;
					$width_long = $width+1;
					$width_top = $width-2;

					$cmd = " -size {$width}x{$height} xc:none -stroke rgba(211,211,211,0.6) -strokewidth 3 -fill none -draw \" line 0,-2 $width_short,1 \" -draw \" line $width_top,2 $width_long,$height  \"";
					exec("magick convert -verbose  $cmd $highlightsMiff");

					// Crop for the edges
					$cmd = " $tempPng ( -clone 0 -crop {$width}x{$height}+{$edge}+{$edge} $highlightsMiff -composite -write $centerMiff +delete )".
					" ( -size  500x500 xc:white -alpha set -crop {$width}x{$edge}+0+{$height} -write $topMiff +delete )".
					" -size  500x500 xc:white -alpha set -gravity northeast -crop {$edge}x{$height}+{$width}+0 -write $rightMiff +delete null: ";
					exec("magick convert -verbose  $cmd ");

					// Perspective for the RHS
					$cmd = " $rightMiff -virtual-pixel background -background none ".
					" +distort Perspective \"0,0 0,0  $edge,0 $shrink,-$alpha  $edge,$height $shrink,$short_side  0,$height 0,$height\" +repage -trim";
					exec("magick convert -verbose  $cmd $rightEdgeMiff");

					// Perspective for the top
					$cmd = " $topMiff -virtual-pixel background -background none ".
					" +distort Perspective \"0,0 $shrink,0  $width,0 $top_long,0  $width,$edge $width,$alpha  0,$edge 0,$alpha\" +repage -trim";
					exec("magick convert -verbose  $cmd $topEdgeMiff");

					// There was a 1px gap between the RHS and main photo
					$tweek = $width-1;

					// Join the images
					$cmd = " ( -page -1,0 $topEdgeMiff -page +0+$alpha $centerMiff -page +$tweek+0 $rightEdgeMiff -background none -layers merge ) ".
					" ( +clone -background black -shadow 60x10+5+5 ) +swap -background none -layers merge +repage ";
					exec(" magick convert -verbose  $cmd -background white $newFilePath", $output);

					// Cleanup
					unlink($tempPng);
					unlink($highlightsMiff);
					unlink($centerMiff);
					unlink($topMiff);
					unlink($rightMiff);
					unlink($rightEdgeMiff);
					unlink($topEdgeMiff);
					

					// exec('magick convert -verbose "' . $filePath . '" -resize '.$printHeight.'x'.$printWidth.'  resize.gif ( -size ' . $sizHeight . 'x'.$sizeWidth.' xc:' . $canvasColorCode . ' -rotate -90 -alpha set -virtual-pixel transparent +distort Perspective "0,0 -30,20  0,200 -30,179  40,200 0,200  40,0 0,0" ) ( resize.gif  -alpha set -virtual-pixel transparent +distort Perspective "0,0 0,0  0,200  0,200  150,200 100,156  150,0 100,0" ) -background none -compose plus -layers merge  +repage -bordercolor none -compose over -border 15x2 "' . $newFilePath . '"  ', $output);

					break;

				default:
					throw new \Exception("something went wrong in parameters, please contact admin.");

					break;
			}

			return $this->jsonHttpResponse(
				true,
				[
					"new_path" => $newFilePath,
					"new_filename" => $newFileName,
					"output" => $output
				],
				'Frame append in image'
			);
			exit();
		} catch (\Exception $e) {
			return $this->jsonHttpResponse(false, [], $e->getMessage());
			exit();
		}
	}

	/**
	 * Generate new file name and full path to store image 
	 * @param string $options
	 * 
	 * @return array
	 */
	public function newFilenameAndPath($options)
	{
		$pathinfo = pathinfo($options['filePath']);
		
		$newFileName =  $options['product_id'] . "_" . 
						$options['type_code'] . "_" . 
						$options['media_code'] . "_" .
						$options['glazing_code'] . "_" . 
						$options['frame_code'] . "_" . 
						$options['printheight'] . "_" .
						$options['printwidth'] . "_" . 
						$options['mat_code'] . "_" . 
						$options['matwidth'] . "_" . time() .".png";

		$newFilePath = __DIR__ . DIRECTORY_SEPARATOR . $newFileName;

		return [$newFileName, $newFilePath];
	}

	/**
	 * Get original file image geometry data
	 * @param string $filePath
	 * 
	 * @return array
	 */
	public function getImageGeometry($filePath)
	{
		$file = new \Imagick($filePath);
		$fileGeometry = $file->getImageGeometry();
		$fileWidth = $fileGeometry['width'];
		$fileHeight = $fileGeometry['height'];

		return [$fileWidth, $fileHeight];
	}

	/**
	 * Get original file image geometry data
	 * @param boolean $status
	 * @param array $data
	 * @param string $message
	 * 
	 * @return json
	 */
	public function jsonHttpResponse($status = false, $data = [], $message = "")
	{
		ob_clean();
		header_remove();
		header("Content-type: application/json; charset=utf-8");

		$status === true ? http_response_code(200) : http_response_code(400);

		return json_encode([
			'data' => $data,
			'status' => $status,
			"message" => $message
		]);
	}
}


// Get image from product using product_id 
$filePath = __DIR__ . DIRECTORY_SEPARATOR . "pic" . DIRECTORY_SEPARATOR . "pexels-flickr-149419_1.jpg";

$overlayTop1 = $overlayBottom1 = __DIR__ . DIRECTORY_SEPARATOR . "VW 110" . DIRECTORY_SEPARATOR . "W110-02" . DIRECTORY_SEPARATOR . "Mobile" . DIRECTORY_SEPARATOR . "W110-02_Top.jpg";

// For Print Only
$optionsPO = [
	"type_code" => "PT01"
];

// For Print and Frame
$optionsPF = [
	"filePath" => $filePath,
	"frame_image" => $overlayTop1,
	"mat_width" => "0",
	"mat_color_code" => "red",
	"type_code" => "PT03",
	"frame_code" =>  0,
	"glazing_code" =>  0,
	"mat_code" =>  0,
	"mat_width" =>  3,
	"media_code" =>  "PM02",
	"printheight" =>  26,
	"printwidth" =>  40,
	"product_id" =>  261,
	//"type_code" =>  "PT02",
];

// For Wrapped Canvas
$optionsWC = [
	"type_code" => "PT02",
	"filePath" => $filePath,
	"canvas_color_code" => "red",
	"frame_code" =>  0,
	"glazing_code" =>  0,
	"mat_code" =>  0,
	"mat_width" =>  0,
	"media_code" =>  "PM02",
	"printheight" =>  26,
	"printwidth" =>  40,
	"product_id" =>  258,
	"type_code" =>  "PT02",
];


$imageMagickFrameEdge = new imageMagickFrameEdge();
$output = $imageMagickFrameEdge->addFrame($optionsPF);

echo $output;

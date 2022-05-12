<?php

namespace Nihilent\ImageFraming\Helper;

use \Magento\Framework\Filesystem\Driver\File as fileDriver;

class imageData
{
    const PT_PRINT_ONLY = "PT01";
    const PT_WRAPPED_CANVAS = "PT02";
    const PT_PRINT_FRAME = "PT03";

    /**
     * Generate new file name and full path to store image
     * @param array $options
     *
     * @return array
     */
    public function newFilenameAndPath($options)
    {
        $pathinfo = pathinfo($options['filePath']);

        // 1234_PT01_PM01_M01_S01_GL01_W107-07_10_16

        $newFileName =  $options['product_id'] . "_" .
            $options['type_code'] . "_" .
            $options['media_code'] . "_" .
            $options['mat_code'] . "_" .
            //$options['s_code'] . "_" .
            $options['glazing_code'] . "_" .
            $options['frame_code'] . "_" .
            //$options['printheight'] . "_" .
            //$options['printwidth'] . "_" .
            $options['matwidth'] . "_" .
            trim($options['mat_color_code'], '#');

        if(isset($options['own_photograph_path']) && !empty($options['own_photograph_path'])){
            $newFileName = $newFileName . "_" .time() ;
        }             

        $newFileName = $newFileName .".png";// .$pathinfo['extension'];

        $newFilePath = $options['imagefolder'] . $newFileName;

        return [$newFileName, $newFilePath];
    }

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
                if(isset($options['own_photograph_path']) && !empty($options['own_photograph_path'])){
                    return $options['own_photograph_path'];
                }   

                throw new \Exception("No need to modify anything for painting.");
            }

            $filePath = $options['filePath'];

            // Get original file geometry array
            [$fileWidth, $fileHeight] = $this->getImageGeometry($filePath);

            // Generate new file name and full path to store image
            [$newFileName, $newFilePath] = $this->newFilenameAndPath($options);

            // Get new file store path info
            $imageFolderPathInfo = pathinfo($options['imagefolder']);

            $fileDriver = new fileDriver();
            if ($fileDriver->isExists($newFilePath)) {
                if(isset($options['reset_image']) && $options['reset_image']){
                    unlink($newFilePath);
                }
                else {
                    return $imageFolderPathInfo['basename'] . DIRECTORY_SEPARATOR .$newFileName;
                    exit();
                }
            }

            $output = "";

            switch ($options['type_code']) {
                case SELF::PT_PRINT_FRAME:                
                    $frameinches = $options['frame_inches'];
                    $frameImage = $options['frame_image'];

                    // Get original file geometry array
                    [$overlayWidth, $overlayHeight] = $this->getImageGeometry($frameImage);

                    $overlayHeightTemp = $overlayHeight;

                    if ($overlayWidth < $overlayHeight) {
                        $overlayHeight = $overlayWidth;
                    }

                    $matteSize = isset($options['matwidth']) ? $options['matwidth'] : 0; 

                    if($matteSize == 0 ){
                        exec("convert -verbose '" . $filePath . "'  -write mpr:image +delete '" . $frameImage . "' -write mpr:edge_top +delete '" . $frameImage . "' -rotate 0 -write mpr:edge_btm +delete mpr:image -alpha set -bordercolor none -compose Dst -frame " . ($overlayHeight) . "x" . ($overlayHeight) . "+" . ($overlayHeight) . "  -compose over -tile mpr:edge_btm -transverse -draw 'color 1,0 floodfill' -transpose  -draw 'color 1,0 floodfill' -tile mpr:edge_top -transverse -draw 'color 1,0 floodfill' -transpose  -draw 'color 1,0 floodfill' mpr:image -gravity center -bordercolor none -composite '" . $newFilePath . "'", $output);
                    }
                    else{
                        $matteColor = isset($options['mat_color_code']) ? $options['mat_color_code'] : "#ffffff";            
                        $inches = ($frameinches > 1) ? 30 : 100;                   
                        $matteSize = $matteSize * ($frameinches * $inches);

                        exec("convert -verbose '" . $filePath . "' -write mpr:image +delete '" . $frameImage . "' -write mpr:edge_top +delete '" . $frameImage . "' -rotate 0 -write mpr:edge_btm +delete mpr:image -alpha set -bordercolor '" . $matteColor . "' -border " . $matteSize . " -compose Dst -frame " . ($overlayHeight) . "x" . ($overlayHeight) . "+" . ($overlayHeight) . "  -compose over -tile mpr:edge_btm -transverse -draw 'color 1,0 floodfill' -transpose  -draw 'color 1,0 floodfill' -tile mpr:edge_top -transverse -draw 'color 1,0 floodfill' -transpose  -draw 'color 1,0 floodfill' mpr:image -gravity center -bordercolor none -composite '" . $newFilePath . "'", $output);
                    }

                    break;

                case SELF::PT_WRAPPED_CANVAS:                                    
                    $canvasColorCode = isset($options['canvas_color_code']) ? $options['canvas_color_code'] : '#ffffff';

                    $tempPartInfo = pathinfo($filePath);
                    $tempFileName = $tempPartInfo['filename'];
                    $tempFileExtension = $tempPartInfo['filename'];

                    // Temp file name remove when process finish
                    $tempPng = $options['imagefolder'].$tempFileName."temp.png";
                    $highlightsMiff = $options['imagefolder'].$tempFileName."highlights.miff";
                    $centerMiff = $options['imagefolder'].$tempFileName."center.miff";
                    $topMiff = $options['imagefolder'].$tempFileName."top.miff";
                    $rightMiff = $options['imagefolder'].$tempFileName."right.miff";
                    $rightEdgeMiff = $options['imagefolder'].$tempFileName."right_edge.miff";
                    $topEdgeMiff = $options['imagefolder'].$tempFileName."top_edge.miff";

                    // Resize to a png to stop quality loss
                    exec("convert -verbose  $filePath -thumbnail 500x500 $tempPng", $output1);

                    $size = getimagesize($tempPng);                 
                    $edge = $size[0]*.05+10;                   
                    $width = $size[0] - ( $edge * 1 );
                    $height = $size[1] - ( $edge * 1 );                 
                    $shrink = round(( $edge * 0.6 ), 4);                    
                    $angle = 45;                                        
                    $radian = ( $angle * Pi() ) / 180;
                    $alpha = round((tan($radian) * $shrink), 4);                    
                    $short_side = round( ($height - $alpha ), 4);                   
                    $top_long = round($width + $shrink, 4);

                    // Create the highlights image
                    $width_short = $width-1;
                    $width_long = $width+1;
                    $width_top = $width+1;

                    $cmd = " -size {$width}x{$height} xc:none -stroke rgba\(211,211,211,0.1\) -strokewidth 0 -fill none -draw \" line 0,-2 $width_short,1 \" -draw \" line $width_top,2 $width_long,$height  \"";
                    exec("convert -verbose  $cmd '$highlightsMiff'", $output2);

                    // Crop for the edges
                    $cmd = " $tempPng \( -clone 0 -crop {$width}x{$height}+{$edge}+{$edge} $highlightsMiff -composite -write $centerMiff +delete \)".
                    " \( -size  700x700 xc:white -alpha set -crop {$width}x{$edge}+0+{$height} -write $topMiff +delete \)".
                    " -size  700x700 xc:white -alpha set -gravity northeast -crop {$edge}x{$height}+{$width}+0 -write $rightMiff +delete null: ";
                    exec("convert -verbose  $cmd ", $output3);

                    // Perspective for the RHS
                    $cmd = " $rightMiff -virtual-pixel background -background none ".
                    " +distort Perspective \"0,0 0,0  $edge,0 $shrink,-$alpha  $edge,$height $shrink,$short_side  0,$height 0,$height\" +repage";
                    exec("convert -verbose  $cmd $rightEdgeMiff", $output4);

                    // Perspective for the top
                    $cmd = " $topMiff -virtual-pixel background -background none ".
                    " +distort Perspective \"0,0 $shrink,0  $width,0 $top_long,0  $width,$edge $width,$alpha  0,$edge 0,$alpha\" +repage";
                    exec("convert -verbose  $cmd $topEdgeMiff", $output5);

                    // There was a 1px gap between the RHS and main photo
                    $tweek = $width-1;

                    // Join the images
                    $cmd = " \( -page -1,0 $topEdgeMiff -page +0+$alpha $centerMiff -page +$tweek+0 $rightEdgeMiff -background none -layers merge \) ".
                    " \( +clone -background black -shadow 60x10+5+5 \) +swap -background none -layers merge +repage ";
                    exec(" convert -verbose  $cmd -background white $newFilePath", $output);

                    // Cleanup
                    unlink($tempPng);
                    unlink($highlightsMiff);
                    unlink($centerMiff);
                    unlink($topMiff);
                    unlink($rightMiff);
                    unlink($rightEdgeMiff);
                    unlink($topEdgeMiff);
                    
                    break;

                default:
                    throw new \Exception("something went wrong in parameters, please contact admin.");

                    break;
            }
            
            return $imageFolderPathInfo['basename'] . DIRECTORY_SEPARATOR .$newFileName;
            exit();
        } catch (\Exception $e) {
            return $e->getMessage();
            exit();
        }
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
}

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <style type="text/css">
    img {
      width: 500px;
      height: 500px;
    }
  </style>
</head>
<body>
<?php
  function convert_tiff_image($file, $extensionType) {
      /* Push all image data*/
      $imageData = [];

      /* Read the image */
      $image = new Imagick($file); 

      /* Sets the format of a particular image */
      $image->setImageFormat($extensionType); 
      
      /* Providing 0 forces thumbnail Image to maintain aspect ratio */
      $image->thumbnailImage(1024,0);

      /* Sets the image compression */
      $image->setImageCompression(Imagick::COMPRESSION_JPEG);

      /* Sets the image compression quality */
      $image->setImageCompressionQuality(90);
      
      /* Transforms an image to a new colorspace */
      $image->transformImageColorspace(Imagick::COLORSPACE_SRGB); 
      
      // New jpeg file name
      $newImageName = pathinfo($file, PATHINFO_FILENAME) . '.'.$extensionType;   
      // Create a store folder if directory is not exists
      $newFolder = "images/" . DIRECTORY_SEPARATOR;
      $newFilePath = __DIR__ . DIRECTORY_SEPARATOR . $newFolder;
      if (!file_exists($newFilePath)) {
          if (!mkdir($newFilePath, 0777, true)) {
              return false;
          }
      }

      /* Writes an image to the specified filename */
      $image->writeImage($newFilePath . basename($newImageName));

      //Get dimensions of the image
      $imageData['filename'] = basename($newImageName);
      $imageData['image_url'] = $newFolder . basename($newImageName);
      $imageData['file_path'] = $image->getImageFilename();
      // Get Image height and width
      $dimensions = $image->getImageGeometry();      
      $imageData['width'] = $dimensions['width'];
      $imageData['height'] = $dimensions['height'];

      $image->clear();

      return $imageData;
  }

  try
  {
    $file = __DIR__ . DIRECTORY_SEPARATOR . "abc.tiff";

    echo "File: ". $file . "<br/>";

    $imageData = convert_tiff_image($file, 'jpeg');

    echo "<pre>";
    print_r($imageData);
    echo "</pre>";

    echo "<img src='".$imageData['image_url']."' alt='".$imageData['filename']."' />";

  }
  catch(Exception $e)
  {
    echo $e->getMessage();
  }
?>
</body>
</html>

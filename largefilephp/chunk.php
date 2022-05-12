<?php
// Send json response
function verbose ($ok=1, $info="") {
  if ($ok==0) { 
    http_response_code(400); 
  }

  exit(
    json_encode([
      "ok"=>$ok, 
      "info"=>$info
    ])
  );
}

// Check any error in uploaded file or not
if (empty($_FILES) || $_FILES["file"]["error"]) {
  verbose(0, "Failed to move uploaded file.");
}

// Check destination folder is create or not then create
$filePath = __DIR__ . DIRECTORY_SEPARATOR . "uploads";
if (!file_exists($filePath)) { 
  if (!mkdir($filePath, 0777, true)) {
    verbose(0, "Failed to create $filePath");
  }
}

// Get original file name and destination filepath
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES["file"]["name"];
$filePath = $filePath . DIRECTORY_SEPARATOR . $fileName;

// Check file already exists or not
if (file_exists($filePath)) {
  verbose(0, "File already exists.");
}

// Check file extension and only allowed extension validat
$allowedImageExtension =  ['jpeg','jpg', "png", "gif", "bmp", "tff", "tiff"];
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

if(!in_array($fileExtension, $allowedImageExtension) ) {
  verbose(0, "Failed to validate extension.");
}


// Deal with chunks data
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
if ($out) {
  $in = @fopen($_FILES["file"]["tmp_name"], "rb");
  if ($in) { 
    while ($buff = fread($in, 4096)) { 
      fwrite($out, $buff); 
    } 
  }
  else { 
    verbose(0, "Failed to open input stream"); 
  }
  @fclose($in);
  @fclose($out);
  @unlink($_FILES["file"]["tmp_name"]);
} 
else { 
  verbose(0, "Failed to open output stream"); 
}

// Check if file has beed uploaded or not
if (!$chunks || $chunk == $chunks - 1) { 
  rename("{$filePath}.part", $filePath); 
}

// retutn success response
verbose(1, "Upload OK");
<?php
	/** 
	 * large file upload";
	 */

	// print_r($_FILES['file']);
	// die();

	$name = $_FILES["file"]["name"];
	$type = $_FILES["file"]["type"];
	$tmp_name = $_FILES["file"]["tmp_name"];
	$error = $_FILES["file"]["error"];
 	$size = $_FILES["file"]["size"];

  	move_uploaded_file($tmp_name, $name);
  	echo "OK";
?>
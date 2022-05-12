<?php

namespace Nihilent\BulkUpload\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * Send json response
     *
     * @param integer $ok
     * @param string $info
     * @param array $data
     * @return void
     */
    public function generateResponse($ok = 1, $info = "", $data = [])
    {
        if ($ok == 0) {
            http_response_code(400);
            $data = [];
        }

        exit(json_encode([
            "status" => $ok === 0 ? "error" : "success",
            "message" => $info,
            "data" => $data
        ]));
    }

    /**
     * Check destination folder is create or not then create
     *
     * @param string $filePath
     * @return array
     *
     * @throws \Magento\Framework\Exception\AlreadyExistsException if the folder not create
     */
    public function createPathFolder($filePath = "")
    {
        if (!file_exists($filePath)) {
            if (!mkdir($filePath, 0777, true)) {
                throw new \Magento\Framework\Exception\AlreadyExistsException(
                    __('Failed to create ' . $filePath)
                );
            }
        }

        return [1, $filePath];
    }

    /**
     * Check file extension and only allowed extension validate
     *
     * @param string $fileName
     * @param array $allowedImageExtension
     * @return array
     *
     * @throws \Magento\Framework\Exception\AlreadyExistsException if the file extension not allowed
     */
    public function checkFileExtension($fileName = "", $allowedImageExtension = [])
    {
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedImageExtension)) {
            throw new \Magento\Framework\Exception\AlreadyExistsException(
                __('Failed to validate extension.')
            );
        }

        return [1, "valid extension.", $fileExtension];
    }

    /**
     * Fetch chunck file and working on it
     *
     * @param array $postData
     * @param string $tempFilePath
     * @param string $originFilePath
     * @param string $fileName
     * @return array
     *
     * @throws \Magento\Framework\Exception\AlreadyExistsException if the chunk stream not open input/output
     */
    public function chunckFile($postData = array(), $tempFilePath = "", $originFilePath = "", $fileName = "")
    {
        $chunk = isset($postData["chunk"]) ? intval($postData["chunk"]) : 0;
        $chunks = isset($postData["chunks"]) ? intval($postData["chunks"]) : 0;
        $out = @fopen($tempFilePath, $chunk == 0 ? "wb" : "ab");
        if ($out) {
            $in = @fopen($_FILES["file"]["tmp_name"], "rb");
            if ($in) {
                while ($buff = fread($in, 4096)) {
                    fwrite($out, $buff);
                }
            } else {
                throw new \Magento\Framework\Exception\AlreadyExistsException(
                    __('Failed to open input stream')
                );
            }
            @fclose($in);
            @fclose($out);
            @unlink($_FILES["file"]["tmp_name"]);
        } else {
            throw new \Magento\Framework\Exception\AlreadyExistsException(
                __('Failed to open output stream')
            );
        }

        // Check if file has beed uploaded or not
        $is_process_finish = false;
        if (!$chunks || $chunk == $chunks - 1) {
            rename($tempFilePath, $originFilePath);
            $is_process_finish = true;
        }

        return [1, "Upload OK", [
            'file_name' => $fileName,
            'file_path' => $originFilePath,
            'is_process_finish' => $is_process_finish
        ]];
    }

    /**
     * Images Comverted to the give type and store in folder
     *
     * @param string $type
     * @param string $filePath
     * @param string $newPath
     * @return array
     */
    public function imageConvert($type = "jpeg", $filePath = "", $newPath = "")
    {
        /* Push all image data*/
        $imageData = [];

        /* Read the image */
        $image = new \Imagick($filePath);

        /* Sets the format of a particular image */
        $image->setImageFormat($type);

        if (in_array($type, ["jpg", "jpeg"])) {
            /* Providing 0 forces thumbnail Image to maintain aspect ratio */
            //$image->thumbnailImage(1024, 0);

            /* Sets the image compression */
            $image->setImageCompression(\Imagick::COMPRESSION_JPEG);

            /* Sets the image compression quality */
            //$image->setImageCompressionQuality(90);

            /* Transforms an image to a new colorspace */
            $image->transformImageColorspace(\Imagick::COLORSPACE_SRGB);
        }

        // New jpeg file name
        $newImageName = pathinfo($filePath, PATHINFO_FILENAME) . '.' . $type;

        /* Writes an image to the specified filename */
        if (!str_ends_with($newPath, '/')) {
            $newPath = $newPath . DIRECTORY_SEPARATOR;
        }

        $image->writeImage($newPath . basename($newImageName));
        $image->clear();

        $extraInfo = pathinfo($filePath);
        if (in_array($type, ["jpg", "jpeg"])) {
            $data['jpeg_image_name'] = $newImageName;
            $data['tiff_image_name'] = $extraInfo['basename'];
        } else {
            $data['jpeg_image_name'] = $extraInfo['basename'];
            $data['tiff_image_name'] = $newImageName;
        }

        $data['filename'] = basename($newImageName);

        return $data;
    }

    /**
     * get basic image information
     *
     * @param string $imageName
     * @return string
     */
    public function imageInfo($imageName)
    {
        $info = pathinfo($imageName);

        return $info['filename'];
    }
}

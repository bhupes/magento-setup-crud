<?php

namespace Nihilent\BulkUpload\Model\Api;

use Psr\Log\LoggerInterface;
use Nihilent\BulkUpload\Helper\Data;
use Magento\Framework\App\Filesystem\DirectoryList;

class BulkUpload
{
    protected $logger;
    public function __construct(
        LoggerInterface $logger,
        Data $helper,
        \Appbroker\UploadArtwork\Model\UploadImage $UploadImage,
        \Magento\Framework\Filesystem $filesystem
    ) {
        $this->logger = $logger;
        $this->helper = $helper;
        $this->UploadImage = $UploadImage;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }
    /**
     * @inheritdoc
     */
    public function storeUpload()
    {
        $imagefolder = $this->_mediaDirectory->getAbsolutePath('tempimg' . DIRECTORY_SEPARATOR);
        if (!is_dir($imagefolder)) {
            $this->helper->createPathFolder($imagefolder);
        }

        $tifffolder = $this->_mediaDirectory->getAbsolutePath('temptiff' . DIRECTORY_SEPARATOR);
        if (!is_dir($tifffolder)) {
            $this->helper->createPathFolder($tifffolder);
        }

        try {
            // Check any error in uploaded file or not
            if (empty($_FILES) || $_FILES["file"]["error"]) {
                throw new \Magento\Framework\Exception\AlreadyExistsException(
                    __('Failed to move uploaded file.')
                );
            }

            // POST data
            $data['type'] = $_POST['type'];
            $data['artist_id'] = $_POST['artist_id'];
            $data['sub_artist_id'] = $_POST['sub_artist_id'];

            // Get original file name and destination filepath
            $fileName = isset($_POST["name"]) ? $_POST["name"] : $_FILES["file"]["name"];

            // Check file extension and only allowed extension validate
            $allowedImageExtension =  ['jpeg', 'jpg', "tif", "tiff"];
            [$extStatus, $message, $fileExtension] = $this->helper->checkFileExtension($fileName, $allowedImageExtension);

            // Check destination folder is create or not then create
            if (in_array($fileExtension, ["tif", "tiff"])) {
                $filePath = $tifffolder;
                $newDirName = $imagefolder;
            }

            if (in_array($fileExtension, ["jpg", "jpeg"])) {
                $filePath = $imagefolder;
                $newDirName = $tifffolder;
            }

            // Check file already exists or not
            $filePath = $filePath . DIRECTORY_SEPARATOR . $fileName;
            // if (file_exists($filePath)) {
            //     throw new \Magento\Framework\Exception\AlreadyExistsException(
            //         __('File already exists.')
            //     );
            // }

            // Fetch chunck file and working on it
            $filepPartialName = "{$filePath}.part" . $_POST['artist_id'];
            [$chukckStatus, $message, $proccessData] = $this->helper->chunckFile($_POST, $filepPartialName, $filePath, $fileName);
            if ($chukckStatus !== 0) {
                // file_name, file_path, is_process_finish
                if ($proccessData['is_process_finish']) {
                   

                    if (strtolower($data['type'])  === "framerprod") {
                        //  Convert tiff file to jpeg
                        if (in_array($fileExtension, ["tif", "tiff"])) {
                            $convert = $this->helper->imageConvert("jpeg", $proccessData['file_path'], $newDirName);
                            $imagepath = $convert['filename'];
                        }

                        //  Convert jpeg file to tiff
                        if (in_array($fileExtension, ["jpg", "jpeg"])) {
                            $convert = $this->helper->imageConvert("tiff", $proccessData['file_path'], $newDirName);
                            $imagepath = $fileName;
                        }

                        $data['upload_image'] = $imagepath;
                      //  $data['title'] = $this->helper->imageInfo($convert['filename']);
                      $data['title'] = $this->helper->imageInfo($proccessData['file_name']);
                        $data['fileName'] = $proccessData['file_path'];
                        $data['extra_params'] = $convert;
                        

                        $this->UploadImage->bulkuploadframes($data);
                    }

                    if (strtolower($data['type'])  === "simple") {
                        $data['upload_image'] = $proccessData['file_name'];
                        $data['title'] = $this->helper->imageInfo($proccessData['file_name']);

                        $this->UploadImage->bulkuploadpainting($data);
                    }
                    unset($proccessData['file_path']);
                    unset($data['fileName']);
                    $data['proccess_data'] = $proccessData;
                    
                }
            }

            // retutn success response
            $this->helper->generateResponse($chukckStatus, $message, $data);
        } catch (\Exception $e) {
            $this->logger->info($e->getMessage());

            $this->helper->generateResponse(0, $e->getMessage());
        }
    }
}

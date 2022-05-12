<?php

namespace Nihilent\ImageFraming\Model;

use Magento\Backend\App\Action\Context;
use \Nihilent\ImageFraming\Helper\imageData;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Catalog\Model\Product\Media\Config;
use Magento\Framework\Filesystem;

class ImageFraming
{
    protected $request;
    protected $resultJsonFactory;
    private $mediaConfig;
    private $filesystem;

    public function __construct(
        LoggerInterface $logger,
        \Magento\Framework\Webapi\Rest\Request $request,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        Config $mediaConfig,
        Filesystem $filesystem,
        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
        $this->logger = $logger;
        $this->request = $request;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->mediaConfig = $mediaConfig;
        $this->filesystem = $filesystem;
        $this->_resourceConnection = $resourceConnection;
    }

    /**
     * {@inheritdoc}
     */
    public function imageChanges()
    {
        try {
            $imagefolder = $this->_mediaDirectory->getAbsolutePath('product_images' . DIRECTORY_SEPARATOR);
            if (!is_dir($imagefolder)) {
                mkdir($imagefolder, 0777, true);
            }

            $param = $this->request->getBodyParams();
            if (!isset($param['product_id'])) {
                throw new \Magento\Framework\Exception\AlreadyExistsException(
                    __('Product id is required.')
                );
            }

            $productId = $param['product_id'];
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $product = $objectManager->create('Magento\Catalog\Model\Product')->load($productId);

            if ($product->validate() !== true) {
                throw new \Magento\Framework\Exception\AlreadyExistsException(
                    __('Product not found.')
                );
            }

            // Get image from product using product_id
            $directory = $this->filesystem->getDirectoryRead('media');
            $fullImagePath = $directory->getAbsolutePath($this->mediaConfig->getMediaPath($product->getThumbnail()));
            if(isset($param['own_photograph_path']) && !empty($param['own_photograph_path'])){
                $fullImagePath = $directory->getAbsolutePath($param['own_photograph_path']);
            }             

            // Get frame image using frame_code
            $overlayTop = "";
            $frameInches = 0.00;
            if (isset($param['frame_code']) && $param['frame_code'] !== 0) {
                $connection = $this->_resourceConnection->getConnection(); 
                $query = $connection->select()
                    ->from('frames', ['*'])
                    ->where('frame_code = ?', $param['frame_code']);
                $fetchData = $connection->fetchRow($query);
                if ($fetchData) {
                    $overlayTop = $directory->getAbsolutePath($fetchData['horizontal']);
                    $frameInches = $fetchData['frame_width'];
                }
            }

            $param["filePath"] = $fullImagePath;
            $param["frame_image"] = $overlayTop;
            $param["frame_inches"] = $frameInches;
            //$param["mat_color_code"] = "#c0c0df";
            //$param["canvas_color_code"] = "red";
            $param['imagefolder'] = $imagefolder;

            $imageData = new imageData();
            $output = $imageData->addFrame($param);

            $this->logger->info("Image creator Done :: " . $output);

            return $output;
        } catch (\Exception $e) {
            $this->logger->info("Image creator Failed :: " . $e->getMessage());
            return "";
        }
    }
}

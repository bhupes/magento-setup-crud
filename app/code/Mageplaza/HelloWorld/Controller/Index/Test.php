<?php

namespace Mageplaza\Helloworld\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {

        echo "Hello World";
        exit;
    }
}

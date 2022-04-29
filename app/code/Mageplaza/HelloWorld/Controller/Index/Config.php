<?php

namespace Mageplaza\HelloWorld\Controller\Index;

class Config extends \Magento\Framework\App\Action\Action
{

    protected $helperData;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Mageplaza\HelloWorld\Helper\Data $helperData

    ) {
        $this->helperData = $helperData;
        return parent::__construct($context);
    }

    public function execute()
    {

        // TODO: Implement execute() method.

        echo "Enable : " . $this->helperData->getGeneralConfig('enable') . "<br/><br/>";
        echo "Display Text : " . $this->helperData->getGeneralConfig('display_text') . "<br/>";
        exit();
    }
}

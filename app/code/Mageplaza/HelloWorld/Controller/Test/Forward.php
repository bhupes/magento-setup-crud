<?php

namespace Mageplaza\Helloworld\Controller\Index;

class Forword extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $this->_forward('Hello Forward');
    }
}

<?php

namespace Nihilent\BulkUpload\Api;

interface BulkUploadInterface
{
    /**
     * Post method for store bulk upload api
     * @return string
     */
    public function storeUpload();
}

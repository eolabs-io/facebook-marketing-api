<?php

namespace EolabsIo\FacebookMarketingApi\Domain\Reporting;

use EolabsIo\FacebookMarketingApi\Domain\Shared\FacebookMarketingApiCore;

abstract class ReportCore extends FacebookMarketingApiCore
{

    public function __construct()
    {
        parent::__construct();

        $this->useGetMethod();
    }

    public function getApiVersion(): string
    {
        return 'v13.0';
    }

}

<?php

namespace EolabsIo\FacebookMarketingApi\Domain\Reporting;

use EolabsIo\FacebookMarketingApi\Domain\Reporting\ReportCore;
use EolabsIo\FacebookMarketingApi\Support\Concerns\InteractsWithAccessToken;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Concerns\InteractsWithAdObject;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Concerns\InteractsWithInsights;

class Insights extends ReportCore
{
    use InteractsWithAccessToken,
        InteractsWithInsights,
        InteractsWithAdObject;

    public function getEndpoint(): string
    {
        $apiVersion = $this->getApiVersion();
        $adObject = $this->getAdObject();

        return "/{$apiVersion}/{$adObject}/insights";
    }

    public function getParameters(): array
    {
        return array_merge(
            $this->getAccessTokenParameters(),
            $this->getInsightsParameters(),
        );
    }
}

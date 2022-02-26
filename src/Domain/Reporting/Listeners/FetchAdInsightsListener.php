<?php

namespace EolabsIo\FacebookMarketingApi\Domain\Reporting\Listeners;

use EolabsIo\FacebookMarketingApi\Domain\Reporting\Events\FetchAdInsights;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Jobs\PerformFetchAdInsights;

class FetchAdInsightsListener
{
    public function handle(FetchAdInsights $event)
    {
        $insights = $event->insights;
        PerformFetchAdInsights::dispatch($insights)->onQueue('ad-insights');
    }
}

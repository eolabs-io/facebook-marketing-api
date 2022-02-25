<?php

namespace EolabsIo\FacebookMarketingApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Insights;

/**
 * @see EolabsIo\FacebookMarketingApi\Domain\Reporting\Insights
 */
class FacebookMarketingApiInsights extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Insights::class;
    }
}

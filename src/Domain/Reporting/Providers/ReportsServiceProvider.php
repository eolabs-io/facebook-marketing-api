<?php

namespace EolabsIo\FacebookMarketingApi\Domain\Reporting\Providers;

use EolabsIo\FacebookMarketingApi\Domain\Reporting\Events\FetchAdInsights;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Listeners\FetchAdInsightsListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ReportsServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchAdInsights::class => [
            FetchAdInsightsListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}

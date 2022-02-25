<?php

namespace EolabsIo\FacebookMarketingApi\Domain\Reporting\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Insights;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Events\FetchAdInsights;

class PerformFetchAdInsights implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonAttributionApi\Domain\Reports\Report */
    public $insights;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Insights $insights)
    {
        $this->insights = $insights;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->insights->fetch();

        ProcessAdInsightsResponse::dispatch($results);
        FetchAdInsights::dispatchIf($this->insights->hasNextCursor(), $this->insights);
    }
}

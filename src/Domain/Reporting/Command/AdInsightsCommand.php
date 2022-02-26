<?php

namespace EolabsIo\FacebookMarketingApi\Domain\Reporting\Command;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Events\FetchAdInsights;
use EolabsIo\FacebookMarketingApi\Support\Facades\FacebookMarketingApiInsights;

class AdInsightsCommand extends Command
{
    protected $signature = 'facebook-marketing-api:ad-insights
                            {--ad-account-id= : The ad account to get Insigts from. When null default from config will be used.}
                            {--date-preset-yesterday : Get resutls from yesterday.}
                            {--end-date= : The end date for the report.}
                            {--start-date= : The start date for the report.}';

    protected $description = 'Gets Ad Insight Report from Facebook Marketing API';


    public function handle()
    {
        $this->info('Getting Ad Insight Report from Facebook Marketing API...');

        $adAccountId = $this->option('ad-account-id');
        $datePresetYesterday = $this->option('date-preset-yesterday');
        $until = Carbon::create($this->option('end-date'));
        $since = Carbon::create($this->option('start-date'));
        $fields = $this->getFields();

        $facebookMarketingApiInsights = FacebookMarketingApiInsights::withInsightLevelAd()
            ->withAdAccountId($adAccountId)
            ->withInsightFields($fields);

        // Apply date range
        if ($datePresetYesterday) {
            $facebookMarketingApiInsights->withDatePresetYesterday();
        } else {
            $facebookMarketingApiInsights->withInsightTimeRange($since, $until);
        }

        FetchAdInsights::dispatch($facebookMarketingApiInsights);
    }

    public function getFields(): array
    {
        return [
            'account_id',
            'account_name',
            'ad_id',
            'ad_name',
            'campaign_id',
            'campaign_name',
            'adset_id',
            'adset_name',
            'date_start',
            'date_stop',
            'impressions',
            'spend',
        ];
    }
}

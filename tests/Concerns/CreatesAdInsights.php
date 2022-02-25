<?php

namespace EolabsIo\FacebookMarketingApi\Tests\Concerns;

use EolabsIo\FacebookMarketingApi\Domain\Reporting\Insights;
use Illuminate\Support\Carbon;
use EolabsIo\FacebookMarketingApi\Support\Facades\FacebookMarketingApiInsights;
use EolabsIo\FacebookMarketingApi\Tests\Factories\FacebookMarketingApiInsightsFactory;

trait CreatesAdInsights
{
    public function createAdInsights()
    {
        FacebookMarketingApiInsightsFactory::new()->fakeInsightsResponse();

        return $this->getDefaultAdInsights();
    }

    public function createAdInsightsWithCursor()
    {
        FacebookMarketingApiInsightsFactory::new()->fakeInsightsWithNextCursorResponse();

        return $this->getDefaultAdInsights();
    }

    private function getDefaultAdInsights(): Insights
    {
        $adAccountId = 2291326454;
        $since = Carbon::create(2022, 2, 22);
        $until = Carbon::create(2022, 2, 23);

        $fields = [
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

        return FacebookMarketingApiInsights::withAdAccountId($adAccountId)
                    ->withInsightLevelAd()
                    ->withInsightTimeRange($since, $until)
                    ->withInsightFields($fields);
    }
}

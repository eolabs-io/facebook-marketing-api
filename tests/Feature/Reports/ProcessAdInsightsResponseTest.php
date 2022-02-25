<?php

namespace EolabsIo\FacebookMarketingApi\Tests\Feature\Reports;

use EolabsIo\FacebookMarketingApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\Ad;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\AdSet;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\Campaign;
use EolabsIo\FacebookMarketingApi\Tests\Concerns\CreatesAdInsights;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Models\CostInsight;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Jobs\ProcessAdInsightsResponse;

class ProcessAdInsightsResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesAdInsights;


    protected function setUp(): void
    {
        parent::setUp();

        $adInsights = $this->createAdInsights();
        $results = $adInsights->fetch();

        (new ProcessAdInsightsResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_insights_response()
    {
        $costInsight = CostInsight::first();

        $this->assertEquals($costInsight->account_id, '894253717801637');
        $this->assertEquals($costInsight->campaign_id, '23849669180380374');
        $this->assertEquals($costInsight->adset_id, '23849705582100374');
        $this->assertEquals($costInsight->ad_id, '23849705582130374');
        $this->assertEquals($costInsight->date_start, '2022-02-22 00:00:00');
        $this->assertEquals($costInsight->date_stop, '2022-02-22 00:00:00');
        $this->assertEquals($costInsight->impressions, '2562');
        $this->assertEquals($costInsight->spend, '20.02');

        $this->assertCampaign();
        $this->assertAdSet();
        $this->assertAd();
    }

    public function assertCampaign()
    {
        $campaign = Campaign::first();

        $this->assertEquals($campaign->id, '23849669180380374');
        $this->assertEquals($campaign->name, 'Amazon Attribution');
    }

    public function assertAdSet()
    {
        $adSet = AdSet::first();

        $this->assertEquals($adSet->id, '23849705582100374');
        $this->assertEquals($adSet->name, 'amazon_in_home_page');
    }

    public function assertAd()
    {
        $ad = Ad::first();

        $this->assertEquals($ad->id, '23849705582130374');
        $this->assertEquals($ad->name, 'probiotics_for_mood');
    }
}

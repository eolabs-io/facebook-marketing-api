<?php

namespace EolabsIo\FacebookMarketingApi\Tests\Unit\Reports;

use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\Ad;
use EolabsIo\FacebookMarketingApi\Tests\Unit\BaseModelTest;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\AdSet;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\Campaign;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Models\CostInsight;

class CostInsightTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return CostInsight::class;
    }

    /** @test */
    public function it_has_campaign_relationship()
    {
        $campaign = Campaign::factory()->create();
        $costInsight = CostInsight::factory()->create(['campaign_id' => $campaign->id]);

        $this->assertArraysEqual($campaign->toArray(), $costInsight->campaign->toArray());
    }

    /** @test */
    public function it_has_ad_set_relationship()
    {
        $adSet = AdSet::factory()->create();
        $costInsight = CostInsight::factory()->create(['adset_id' => $adSet->id]);

        $this->assertArraysEqual($adSet->toArray(), $costInsight->adSet->toArray());
    }

    /** @test */
    public function it_has_ad_relationship()
    {
        $ad = Ad::factory()->create();
        $costInsight = CostInsight::factory()->create(['ad_id' => $ad->id]);

        $this->assertArraysEqual($ad->toArray(), $costInsight->ad->toArray());
    }
}

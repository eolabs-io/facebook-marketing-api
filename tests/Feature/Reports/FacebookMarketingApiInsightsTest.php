<?php

namespace EolabsIo\FacebookMarketingApi\Tests\Feature\Reports;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\FacebookMarketingApi\Tests\TestCase;
use EolabsIo\FacebookMarketingApi\Support\Facades\FacebookMarketingApiInsights;
use EolabsIo\FacebookMarketingApi\Tests\Factories\FacebookMarketingApiInsightsFactory;

class FacebookMarketingApiInsightsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_sends_the_correct_request_query()
    {
        FacebookMarketingApiInsightsFactory::new()->fakeInsightsResponse();

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

        FacebookMarketingApiInsights::withAdAccountId($adAccountId)
            ->withInsightLevelAd()
            ->withInsightTimeRange($since, $until)
            ->withInsightFields($fields)
            ->fetch();

        Http::assertSent(function ($request) {
            return Str::startsWith($request->url(), "https://graph.facebook.com/v13.0/act_2291326454/insights") &&
                   $request->method() == "GET" &&
            // params
                    $request['access_token'] == 'EXAMPLE0b302baf3e644a2baf3e62baf3e' &&
                    $request['level'] == 'ad' &&
                    $request['time_range'] == '{"since":"2022-02-22","until":"2022-02-23"}' &&
                    $request['fields'] == "account_id,account_name,ad_id,ad_name,campaign_id,campaign_name,adset_id,adset_name,date_start,date_stop,impressions,spend";
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        FacebookMarketingApiInsightsFactory::new()->fakeInsightsResponse();

        $adAccountId = 2291326454;

        $response = FacebookMarketingApiInsights::withAdAccountId($adAccountId)
            ->withInsightLevelAd()
            ->fetch();

        $data = $response['data'];

        $this->assertCount(12, $data);

        $data = $data[0];

        $this->assertEquals('894253717801637', $data['account_id']);
        $this->assertEquals('23849705582130374', $data['ad_id']);
        $this->assertEquals('23849669180380374', $data['campaign_id']);
        $this->assertEquals('23849705582100374', $data['adset_id']);
        $this->assertEquals('2022-02-22', $data['date_start']);
        $this->assertEquals('2022-02-22', $data['date_stop']);
        $this->assertEquals('2562', $data['impressions']);
        $this->assertEquals('20.02', $data['spend']);
    }

    /** @test */
    public function it_gets_the_correct_response_with_next_cursor()
    {
        FacebookMarketingApiInsightsFactory::new()->fakeInsightsWithNextCursorResponse();

        $adAccountId = 2291326454;

        $adInsights = FacebookMarketingApiInsights::withAdAccountId($adAccountId)
            ->withInsightLevelAd();

        $nextCursorResponse = $adInsights->fetch();

        $this->assertTrue($adInsights->hasNextCursor());

        $response = $adInsights->fetch();


        $campaignId1 = data_get($response, 'data.0.campaign_id');
        $campaignId2 = data_get($nextCursorResponse, 'data.0.campaign_id');

        $this->assertEquals('23849669180380374', $campaignId1);
        $this->assertEquals('23847917891410374', $campaignId2);

        $this->assertCount(25, $nextCursorResponse['data']);
        $this->assertCount(12, $response['data']);

        $this->assertSentReportWithNextCursor();
    }

    public function assertSentReportWithNextCursor()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[1][0];

        $this->assertTrue(
            Str::startsWith($request->url(), "https://graph.facebook.com/v13.0/act_2291326454/insights") &&
               $request['after'] == "NDkZD"
        );
    }
}

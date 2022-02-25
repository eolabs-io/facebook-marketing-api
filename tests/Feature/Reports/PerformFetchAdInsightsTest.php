<?php

namespace EolabsIo\FacebookMarketingApi\Tests\Feature\Reports;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\FacebookMarketingApi\Tests\TestCase;
use EolabsIo\FacebookMarketingApi\Tests\Concerns\CreatesAdInsights;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Events\FetchAdInsights;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Jobs\PerformFetchAdInsights;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Jobs\ProcessAdInsightsResponse;

class PerformFetchAdInsightsTest extends TestCase
{
    use CreatesAdInsights;

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_calls_the_correct_job_without_cursor()
    {
        $adInsights = $this->createAdInsights();

        PerformFetchAdInsights::dispatch($adInsights);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchAdInsights::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessAdInsightsResponse::class, function ($job) {
            return data_get($job->results, 'data.0.campaign_id') === '23849669180380374';
        });

        // Assert that was not called for Cursor
        Event::assertNotDispatched(FetchAdInsights::class);
    }

    /** @test */
    public function it_calls_the_correct_job_with_cursor()
    {
        $adInsights = $this->createAdInsightsWithCursor();

        PerformFetchAdInsights::dispatch($adInsights);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchAdInsights::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessAdInsightsResponse::class, function ($job) {
            return data_get($job->results, 'data.0.campaign_id') === '23847917891410374';
        });

        // Assert that was not called for Cursor
        Event::assertDispatched(FetchAdInsights::class);
    }
}

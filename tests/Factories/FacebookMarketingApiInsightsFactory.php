<?php

namespace EolabsIo\FacebookMarketingApi\Tests\Factories;

use Illuminate\Support\Facades\Http;

class FacebookMarketingApiInsightsFactory
{
    // private $endpoint = 'graph.facebook.com/v13.0/*/insights';
    private $endpoint = '*';

    public static function new(): self
    {
        return new static();
    }

    public function fake(): self
    {
        Http::fake();

        return $this;
    }

    public function fakeInsightsResponse(): self
    {
        $file = __DIR__ . '/../Stubs/Responses/fetchReportInsightsResponse.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }

    public function fakeInsightsWithNextCursorResponse(): self
    {
        $file = __DIR__ . '/../Stubs/Responses/fetchReportInsightsWithNextCursorResponse.json';
        $withCursorResponse = file_get_contents($file);

        $file = __DIR__ . '/../Stubs/Responses/fetchReportInsightsResponse.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($withCursorResponse, 200)
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }
}

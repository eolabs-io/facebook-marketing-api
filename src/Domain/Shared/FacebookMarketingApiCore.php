<?php

namespace EolabsIo\FacebookMarketingApi\Domain\Shared;

use EolabsIo\FacebookMarketingApi\Support\Concerns\CursorIdable;
use Illuminate\Support\Collection;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use EolabsIo\FacebookMarketingApi\Support\Concerns\Methodable;

abstract class FacebookMarketingApiCore
{
    use Methodable,
        CursorIdable;

    /** @var Illuminate\Http\Client\Response */
    private $response;

    /** @var Illuminate\Support\Collection */
    private $results;

    public function __construct()
    {
        $this->results = new Collection();
        $this->clearCursors();
    }

    public function beforeFetch()
    {
    }

    public function fetch()
    {
        $this->beforeFetch();

        $headers = $this->getHeaders();
        $baseUrl = $this->getBaseUrl();
        $endpoint = $this->getEndpoint();
        $data = array_merge($this->getNextCursorParamters(), $this->getParameters());
        $method = $this->getMethod();

        try {
            $response = Http::withHeaders($headers)
                            ->baseUrl($baseUrl)
                            ->{$method}($endpoint, $data)
                            ->throw();
        } catch (\Exception $exception) {
            // handle exception
            $this->handleException($exception);
        }

        return $this->processResponse($response);
    }

    protected function getHeaders(array $headers = []): array
    {
        return $headers;
    }

    public function getBaseUrl(): string
    {
        return 'https://graph.facebook.com';
    }

    abstract public function getEndpoint(): string;

    public function getParameters(): array
    {
        return [];
    }

    public function handleException(RequestException $requestException)
    {
        throw $requestException;
    }

    public function processResponse(Response $response)
    {
        $this->response = $response;

        $resultsFromResponse = $this->getResultsFromResponse($response);

        $this->checkForCursor($resultsFromResponse);
        $this->results = $this->parseResults($resultsFromResponse);

        return $this->getResults();
    }

    public function getResultsFromResponse(Response $response): Collection
    {
        return $response->collect();
    }

    public function parseResults(Collection $results): Collection
    {
        return $results;
    }

    public function getResults()
    {
        return $this->results;
    }
}

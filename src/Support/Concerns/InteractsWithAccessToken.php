<?php

namespace EolabsIo\FacebookMarketingApi\Support\Concerns;

trait InteractsWithAccessToken
{
    public function getAccessTokenParameters(): array
    {
        return ['access_token' => config('facebook-marketing-api.access_token')];
    }
}

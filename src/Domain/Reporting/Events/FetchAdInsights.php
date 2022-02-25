<?php

namespace EolabsIo\FacebookMarketingApi\Domain\Reporting\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Insights;

class FetchAdInsights
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\FacebookMarketingApi\Domain\Reporting\Insights */
    public $insights;

    public function __construct(Insights $insights)
    {
        $this->insights = $insights;
    }
}

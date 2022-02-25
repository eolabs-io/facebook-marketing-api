<?php

namespace EolabsIo\FacebookMarketingApi\Tests\Unit\Reports;

use EolabsIo\FacebookMarketingApi\Tests\Unit\BaseModelTest;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Models\CostInsight;

class CostInsightTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return CostInsight::class;
    }
}

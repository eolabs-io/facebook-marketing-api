<?php
namespace EolabsIo\FacebookMarketingApi\Domain\Shared\Models;

use EolabsIo\FacebookMarketingApi\Tests\Unit\BaseModelTest;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\Campaign;

class CampaignTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Campaign::class;
    }
}

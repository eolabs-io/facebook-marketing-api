<?php

namespace EolabsIo\FacebookMarketingApi\Domain\Reporting\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Models\CostInsight;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\Ad;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\AdSet;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\Campaign;

class PersistAdInsightsAction extends BasePersistAction
{
    public function getKey(): string
    {
        return 'data';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new CostInsight);
        $attributes = [
            'account_id' => data_get($list, 'account_id'),
            'ad_id' => data_get($list, 'ad_id'),
            'campaign_id' => data_get($list, 'campaign_id'),
            'adset_id' => data_get($list, 'adset_id'),
            'date_start' => data_get($list, 'date_start'),
            'date_stop' => data_get($list, 'date_stop'),
        ];

        $costInsight = CostInsight::updateOrCreate($attributes, $values);

        $this->associateCampaign($list);
        $this->associateAdSet($list);
        $this->associateAd($list);

        return $costInsight;
    }

    public function associateCampaign($list)
    {
        $values = [
            'id' => data_get($list, 'campaign_id'),
            'name' => data_get($list, 'campaign_name'),
        ];
        $attributes = $values;

        Campaign::firstOrCreate($attributes, $values);
    }

    public function associateAdSet($list)
    {
        $values = [
            'id' => data_get($list, 'adset_id'),
            'name' => data_get($list, 'adset_name'),
        ];
        $attributes = $values;

        AdSet::firstOrCreate($attributes, $values);
    }

    public function associateAd($list)
    {
        $values = [
            'id' => data_get($list, 'ad_id'),
            'name' => data_get($list, 'ad_name'),
        ];
        $attributes = $values;

        Ad::firstOrCreate($attributes, $values);
    }
}

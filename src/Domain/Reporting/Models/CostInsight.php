<?php

namespace EolabsIo\FacebookMarketingApi\Domain\Reporting\Models;

use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\Ad;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\AdSet;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\Campaign;
use EolabsIo\FacebookMarketingApi\Database\Factories\CostInsightFactory;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\FacebookMarketingApiModel;

class CostInsight extends FacebookMarketingApiModel
{

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'facebook_cost_insights';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_start' => 'date',
        'date_stop' => 'date',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'account_id',
                    'ad_id',
                    'campaign_id',
                    'adset_id',
                    'date_start',
                    'date_stop',
                    'impressions',
                    'spend',
                ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class)->withDefault();
    }

    public function adSet()
    {
        return $this->belongsTo(AdSet::class, 'adset_id')->withDefault();
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return CostInsightFactory::new();
    }
}

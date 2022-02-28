<?php

namespace EolabsIo\FacebookMarketingApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Models\CostInsight;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\Ad;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\AdSet;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\Campaign;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EolabsIo\FacebookMarketingApi\Domain\Reporting\Models\CostInsight>
 */
class CostInsightFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CostInsight::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_id' => $this->faker->randomNumber(4),
            'ad_id' => Ad::factory(),
            'campaign_id' => Campaign::factory(),
            'adset_id' => AdSet::factory(),
            'date_start' => $this->faker->date('Y-m-d'),
            'date_stop' => $this->faker->date('Y-m-d'),
            'impressions' => $this->faker->randomNumber(),
            'spend' => $this->faker->randomFloat(2),
        ];
    }
}

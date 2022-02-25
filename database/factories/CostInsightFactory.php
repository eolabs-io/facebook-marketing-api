<?php

namespace EolabsIo\FacebookMarketingApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Models\CostInsight;

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
            'ad_id' => $this->faker->randomNumber(4),
            'campaign_id' => $this->faker->randomNumber(4),
            'adset_id' => $this->faker->randomNumber(4),
            'date_start' => $this->faker->date('Y-m-d'),
            'date_stop' => $this->faker->date('Y-m-d'),
            'impressions' => $this->faker->randomNumber(),
            'spend' => $this->faker->randomFloat(2),
        ];
    }
}

<?php

namespace EolabsIo\FacebookMarketingApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Models\AdSet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EolabsIo\FacebookMarketingApi\Domain\Shared\Models\AdSet>
 */
class AdSetFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdSet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4),
            'name' => $this->faker->text(),
        ];
    }
}

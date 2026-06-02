<?php

namespace Database\Factories;

use App\Models\Workforce;
use App\Models\Worksite;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Workforce>
 */
class WorkforceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hrWorking = $this->faker->numberBetween(8, 500);
        $hrRate = Money::EUR($this->faker->numberBetween(2000, 50000));
        $costHrWorking = $hrRate->multiply($hrWorking);
        $additionalCosts = Money::EUR($this->faker->numberBetween(0, 200000));
        $total_gross_cost = $costHrWorking->add($additionalCosts);

        return [
            'code' => $this->faker->numerify('MO-####'),
            'worker' => $this->faker->company(),
            'hr_working' => $hrWorking,
            'hr_rate' => $hrRate,
            'cost_hr_working' => $costHrWorking,
            'additional_costs' => $additionalCosts,
            'total_gross_cost' => $total_gross_cost,
            'worksite_id' => Worksite::factory(),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\WorksitePriority;
use App\Enums\WorksiteStatus;
use App\Models\Worksite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Worksite>
 */
class WorksiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code'              => $this->faker->unique()->bothify('CH-####'),
            'name_worksite'     => $this->faker->sentence(),
            'description'       => $this->faker->paragraph(),
            'start_date'        => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'end_date'          => $this->faker->optional()->dateTimeBetween('+1 year', '+2 years'),
            'worksite_priority' => $this->faker->randomElement(WorksitePriority::cases()),
            'worksite_status'   => $this->faker->randomElement(WorksiteStatus::cases()),
            'street'            => $this->faker->streetAddress(),
            'city'              => $this->faker->city(),
            'zip_code'          => (int) $this->faker->postcode(),
            'country'           => $this->faker->country(),
        ];
    }

    public function inProgress(): static
    {
        return $this->state(fn () => ['worksite_status' => WorksiteStatus::InProgress]);
    }

    public function completed(): static
    {
        return $this->state(fn () => ['worksite_status' => WorksiteStatus::Finished]);
    }

    public function highPriority(): static
    {
        return $this->state(fn () => ['worksite_priority' => WorksitePriority::High]);
    }
}

<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ClientType;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'contact_name' => $this->faker->name(),
            'name'         => null,
            'email'        => $this->faker->unique()->companyEmail(),
            'phone'        => $this->faker->numerify('06########'),
            'company'      => $this->faker->company(),
            'type'         => ClientType::Pro,
            'siret'        => $this->faker->unique()->numerify('##############'),
            'tva_intra'    => $this->faker->unique()->numerify('FR###########'),
            'street'       => $this->faker->streetAddress(),
            'city'         => $this->faker->city(),
            'zip_code'     => (int) $this->faker->postcode(),
            'country'      => 'France',
        ];
    }

    public function professional(): static
    {
        return $this->state(fn () => ['type' => ClientType::Pro]);
    }

    public function individual(): static
    {
        return $this->state(fn () => [
            'type'    => ClientType::Private,
            'company' => null,
        ]);
    }
}

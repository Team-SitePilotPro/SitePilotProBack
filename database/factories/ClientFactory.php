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
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contact_name' => $this->faker->name(),
            'private_name' => null,
            'email' => $this->faker->unique()->companyEmail(),
            'phone' => $this->faker->numerify('06########'),
            'company' => $this->faker->company(),
            'clientType' => ClientType::Pro,
            'siret' => $this->faker->numerify('##############'),
            'tva_intra' => $this->faker->unique()->bothify('FR-##-#########'),
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'zip_code' => $this->faker->postcode(),
            'country' => 'France',
            'user_id' => User::factory(),
        ];
    }

    public function professional(): static
    {
        return $this->state(static fn () => ['type' => ClientType::Pro->value]);
    }

    public function individual(): static
    {
        return $this->state(fn () => [
            'type' => ClientType::Private->value,
            'company' => null,
        ]);
    }
}

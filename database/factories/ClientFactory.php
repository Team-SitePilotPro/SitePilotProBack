<?php

namespace Database\Factories;

use App\Enums\Type;
use App\Models\Address;
use App\Models\Client;
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
            'name' => null,
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->mobileNumber(),
            'company' => $this->faker->company(),
            'type' => $this->faker->randomElement(Type::cases()),
            'siret' => $this->faker->unique()->siret(),
            'tva_intra' => $this->faker->unique()->vat(),
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'zip_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
        ];
    }
}

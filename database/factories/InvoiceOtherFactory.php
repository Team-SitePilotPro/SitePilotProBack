<?php

namespace Database\Factories;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Client;
use App\Models\InvoiceOther;
use App\Models\Worksite;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvoiceOther>
 */
class InvoiceOtherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $purchasePrice = Money::EUR($this->faker->numberBetween(5000, 500000));

        return [
            'delivery_date'  => $this->faker->dateTimeBetween('-6 months', 'now'),
            'number_invoice' => 'FO' . $this->faker->unique()->numerify('#####'),
            'invoice_description'    => $this->faker->sentence(4),
            'purchase_price' => $purchasePrice,
            'cost_price'     => $purchasePrice->multiply($this->faker->randomFloat(2, 1.0, 1.2)),
            'worksite_id'    => Worksite::factory(),
        ];
    }
}

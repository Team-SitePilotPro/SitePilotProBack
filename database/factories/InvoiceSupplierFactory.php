<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InvoiceSupplier;
use App\Models\Worksite;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvoiceSupplier>
 */
class InvoiceSupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $purchasePrice = Money::EUR($this->faker->numberBetween(10000, 1000000));

        return [
            'delivery_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'number_invoice' => 'FF'.$this->faker->unique()->numerify('#####'),
            'invoice_description' => $this->faker->sentence(4),
            'purchase_price' => $purchasePrice,
            'cost_price' => $purchasePrice->multiply($this->faker->randomFloat(2, 1.0, 1.3)),
            'worksite_id' => Worksite::factory(),
        ];
    }
}

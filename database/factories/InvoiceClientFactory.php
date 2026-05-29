<?php

namespace Database\Factories;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Client;
use App\Models\InvoiceClient;
use App\Models\Worksite;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvoiceClient>
 */
class InvoiceClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentStatus = $this->faker->randomElement(PaymentStatus::cases());
        $total_ht = Money::EUR($this->faker->numberBetween(5000, 500000));

        return [
            'delivery_date'  => $this->faker->dateTimeBetween('-6 months', 'now'),
            'number_invoice' => $this->faker->unique()->bothify('FR-####'),
            'invoice_description'    => $this->faker->sentence(4),
            'total_ht'       => $total_ht,
            'payment_status' => $paymentStatus->value,
            'payment_date'   => $paymentStatus === PaymentStatus::Paid
                ? $this->faker->dateTimeBetween('-3 months', 'now')
                : null,
            'payment_method' => $this->faker->randomElement(PaymentMethod::cases())->value,
            'client_id'      => Client::factory(),
            'worksite_id'    => Worksite::factory(),
            'quote_id'       => null,
        ];
    }

    public function paid(): static
    {
        return $this->state(fn () => [
            'payment_status' => PaymentStatus::Paid->value,
            'payment_date'   => now(),
            'payment_method' => PaymentMethod::BankTransfer->value,
        ]);
    }
}

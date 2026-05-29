<?php

namespace Database\Factories;

use App\Enums\QuoteStatus;
use App\Enums\TvaRate;
use App\Models\Client;
use App\Models\Quote;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Quote>
 */
class QuoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotalHt = Money::EUR($this->faker->numberBetween(50000, 5000000)); // centimes
        $tvaRate = $this->faker->randomElement(TvaRate::cases());
        $tvaAmount = $subtotalHt->multiply($tvaRate->numeric() / 100);
        $totalTtc = $subtotalHt->add($tvaAmount);
        $issueDate = $this->faker->dateTimeBetween('-3 months', 'now');

        return [
            'quote_number' => $this->faker->unique()->bothify('DEV-####'),
            'issue_date' => $issueDate,
            'validity_date' => $this->faker->dateTimeBetween($issueDate, '+3 months'),
            'quote_status' => $this->faker->randomElement(QuoteStatus::cases())->value,
            'subtotal_ht' => $subtotalHt,
            'tva_rate' => $tvaRate->value,
            'tva_amount' => $tvaAmount,
            'total_ttc' => $totalTtc,
            'client_id' => Client::factory(),
        ];
    }
    public function accepted(): static
    {
        return $this->state(static fn () => ['quote_status' => QuoteStatus::Accept->value]);
    }

    public function draft(): static
    {
        return $this->state(static fn () => ['quote_status' => QuoteStatus::Draft->value]);
    }
}



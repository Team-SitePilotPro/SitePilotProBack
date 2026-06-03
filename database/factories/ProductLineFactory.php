<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\TvaRate;
use App\Enums\Unit;
use App\Models\ProductLine;
use App\Models\Quote;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductLine>
 */
class ProductLineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 100);
        $unitPriceHt = Money::EUR($this->faker->numberBetween(1000, 100000));
        $tvaRate = TvaRate::Taux20;
        $totalHt = $unitPriceHt->multiply($quantity);
        $tvaAmount = $totalHt->multiply($tvaRate->numeric() / 100);
        $totalTtc = $totalHt->add($tvaAmount);

        return [
            'quote_id' => Quote::factory(),
            'description' => $this->faker->sentence(5),
            'quantity' => $quantity,
            'unit' => $this->faker->randomElement(Unit::cases())->value,
            'unit_price_ht' => $unitPriceHt,
            'tva_rate' => $tvaRate->value,
            'total_ht' => $totalHt,
            'total_ttc' => $totalTtc,
            'sort_order' => $this->faker->numberBetween(1, 20),
            'category' => $this->faker->randomElement([
                'Main d\'œuvre',
                'Matériaux',
                'Équipements',
                'Déplacements',
                null,
            ]),
        ];
    }
}

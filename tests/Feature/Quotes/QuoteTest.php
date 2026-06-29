<?php

declare(strict_types=1);

namespace Feature\Quotes;

use App\Models\Quote;
use Database\Factories\QuoteFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteTest extends TestCase
{
    use RefreshDatabase;

    private Quote $quote;

    protected function setUp(): void
    {
        parent::setUp();

        $this->quote = QuoteFactory::new()->createOne();
    }

    public function test_quotes_index_route_exists(): void
    {
        $response = $this->getJson('/api/v1/quotes');
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
    }

    public function test_should_return_correct_data(): void
    {
        $response = $this->getJson('/api/v1/quotes');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'quote_number' => $this->quote->quote_number,
        ]);
    }

    public function test_should_return_empty_list(): void
    {
        Quote::query()->delete();

        $response = $this->getJson('/api/v1/quotes');

        $response->assertStatus(200);
        $response->assertJsonCount(0, 'data');
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_clients_index_route_exists(): void
    {
        $response = $this->getJson('/api/v1/clients');
        $response->assertStatus(200);
    }

    public function test_worksites_index_route_exists(): void
    {
        $response = $this->getJson('/api/v1/worksites');
        $response->assertStatus(200);
    }
}

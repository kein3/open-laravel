<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_dashboard_route_is_accessible(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_dashboard_displays_order_stats(): void
    {
        $orders = \App\Models\Order::factory()->count(3)->create([
            'total' => 100,
        ]);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('3');
        $response->assertSee('300');
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Order;
use App\Models\User;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_view_receives_stats_and_sales(): void
    {
        Order::factory()->count(2)->create();
        User::factory()->create();

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertViewHasAll(['stats', 'sales']);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Order;

class OrderDatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_persist_orders_to_database(): void
    {
        Order::factory()->create(['total' => 123.45]);

        $this->assertDatabaseHas('orders', [
            'total' => 123.45,
        ]);
    }
}

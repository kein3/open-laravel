<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    use RefreshDatabase;

    public function test_up_route_returns_ok(): void
    {
        $response = $this->get('/up');

        $response->assertStatus(200);
    }
}

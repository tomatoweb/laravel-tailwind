<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    use MakesHttpRequests;

    use RefreshDatabase;
      
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertSuccessful();

        $response->attachFile('file', 'path/to/file', 'file.jpg', 'Content-Type');

        $response->assertSeeText('Dotdev');

        $response->assertRouteHasMiddleware('route', 'middleware');

        $response->expectException('exception', 'message');


    }
}

<?php

namespace Tests\Feature;

use App\Models\TravelRequest;
use Tests\TestCase;

class GetTravelRequestTest extends TestCase
{
    public function test_responds_with_http_ok(): void
    {
        TravelRequest::factory()->create();
        $this->get(route('travel-request.get'))->assertOk();
    }

    public function test_responds_with_travel_requests(): void
    {
        $tr = TravelRequest::factory()->create();

        $this->getJson(route('travel-request.get'))
            ->assertJsonFragment($tr->toArray());
    }
}

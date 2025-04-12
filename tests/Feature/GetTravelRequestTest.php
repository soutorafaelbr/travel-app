<?php

namespace Tests\Feature;

use App\Models\TravelRequest;
use App\Models\User;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('get')]
class GetTravelRequestTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

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

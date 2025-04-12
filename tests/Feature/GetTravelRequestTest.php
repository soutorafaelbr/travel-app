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
        $this->actingAs($loggedUser = User::factory()->create());
        $this->travelRequest = TravelRequest::factory()->create(['user_id' => $loggedUser->id]);
    }

    public function test_responds_with_http_ok(): void
    {
        $this->get(route('travel-request.get'))->assertOk();
    }

    public function test_responds_with_travel_requests(): void
    {
        $this->getJson(route('travel-request.get'))
            ->assertJsonFragment($this->travelRequest->toArray());
    }
}

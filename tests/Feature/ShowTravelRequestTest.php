<?php

namespace Tests\Feature;

use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('show')]
class ShowTravelRequestTest extends TestCase
{
    protected TravelRequest $travelRequest;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($loggedUser = User::factory()->create());
        $this->travelRequest = TravelRequest::factory()->create(['user_id' => $loggedUser->id]);
    }

    public function test_responds_with_http_ok(): void
    {
        $this->withoutExceptionHandling()->getJson(route('travel-request.show', $this->travelRequest))->assertOk();
    }

    public function test_responds_with_json(): void
    {
        $this->getJson(route('travel-request.show', $this->travelRequest->id))
            ->assertJsonFragment($this->travelRequest->toArray());
    }

    public function test_throws_exception_when_TravelRequest_does_not_exists(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->withoutExceptionHandling()
            ->getJson(route('travel-request.show', 12433546));
    }

    public function test_responds_with_not_found_status_code_TravelRequest_does_not_exists(): void
    {
        $this->getJson(route('travel-request.show', 12433546))
            ->assertNotFound();
    }

    public function test_should_own_the_travel_request_requested(): void
    {
        $tr = TravelRequest::factory()->create();

        $this->getJson(route('travel-request.show', $tr->id))
            ->assertForbidden();
    }
}

<?php

namespace Tests\Feature;

use App\Models\TravelOrder;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('show')]
class ShowTravelOrderTest extends TestCase
{
    protected TravelOrder $travelOrder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($loggedUser = User::factory()->create());
        $this->travelOrder = TravelOrder::factory()->create(['user_id' => $loggedUser->id]);
    }

    public function test_responds_with_http_ok(): void
    {
        $this->withoutExceptionHandling()->getJson(route('travel-order.show', $this->travelOrder))->assertOk();
    }

    public function test_responds_with_json(): void
    {
        $this->getJson(route('travel-order.show', $this->travelOrder->id))
            ->assertJsonFragment($this->travelOrder->toArray());
    }

    public function test_throws_exception_when_travel_request_does_not_exists(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->withoutExceptionHandling()
            ->getJson(route('travel-order.show', 12433546));
    }

    public function test_responds_with_not_found_status_code_travel_request_does_not_exists(): void
    {
        $this->getJson(route('travel-order.show', 12433546))
            ->assertNotFound();
    }

    public function test_should_own_the_travel_request_requested(): void
    {
        $tr = TravelOrder::factory()->create();

        $this->getJson(route('travel-order.show', $tr->id))
            ->assertForbidden();
    }
}

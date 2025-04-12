<?php

namespace Tests\Feature;

use App\Models\TravelRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class ShowTravelRequestTest extends TestCase
{
    public function test_responds_with_http_ok(): void
    {
        $tr = TravelRequest::factory()->create();

        $this->getJson(route('travel-request.show', $tr->id))->assertOk();
    }

    public function test_responds_with_json(): void
    {
        $tr = TravelRequest::factory()->create();

        $this->getJson(route('travel-request.show', $tr->id))->assertJsonFragment($tr->toArray());
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
}

<?php

namespace Tests\Feature;

use App\Models\TravelRequest;
use App\TravelRequest\Enums\Status;
use Tests\TestCase;

class UpdateTravelRequestStatusTest extends TestCase
{
    public function test_updates_status(): void
    {
        $travelRequest = TravelRequest::factory()->create();

        $this->patchJson(
            route('travel-request.update-status', $travelRequest->id),
            ['status' => Status::Approved->value]
        );

        $this->assertDatabaseHas(
            TravelRequest::class,
            ['status' => Status::Approved->value, 'id' => $travelRequest->id]
        );
    }

    public function test_responds_with_no_content_status(): void
    {
        $travelRequest = TravelRequest::factory()->create();

        $this->patchJson(
            route('travel-request.update-status', $travelRequest->id),
            ['status' => Status::Approved->value]
        )->assertNoContent();
    }

    public function test_status_must_be_valid(): void
    {
        $travelRequest = TravelRequest::factory()->create();

        $this->patchJson(
            route('travel-request.update-status', $travelRequest->id),
            ['status' => 'invalid-status']
        )->assertJsonValidationErrors('status');
    }
}

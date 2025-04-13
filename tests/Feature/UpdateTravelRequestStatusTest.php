<?php

namespace Tests\Feature;

use App\Domain\TravelRequest\Enums\Status;
use App\Models\TravelRequest;
use App\Models\User;
use App\Notifications\TravelRequestUpdated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('update')]
class UpdateTravelRequestStatusTest extends TestCase
{
    private User $loggedUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->loggedUser = User::factory()->create());
    }

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

    public function test_approved_travel_request_cannot_be_canceled()
    {
        $this->expectException(ValidationException::class);
        $travelRequest = TravelRequest::factory()->create(['status' => Status::Approved->value]);

        $this->withoutExceptionHandling()
            ->patchJson(
                route('travel-request.update-status', $travelRequest->id),
                ['status' => Status::Canceled->value]
            );
    }

    public function test_canceled_travel_request_cannot_be_approved()
    {
        $this->expectException(ValidationException::class);
        $travelRequest = TravelRequest::factory()->create(['status' => Status::Canceled->value]);

        $this->withoutExceptionHandling()
            ->patchJson(
                route('travel-request.update-status', $travelRequest->id),
                ['status' => Status::Approved->value]
            );
    }

    public function test_requested_travel_request_cannot_be_requested()
    {
        $this->expectException(ValidationException::class);
        $travelRequest = TravelRequest::factory()->create(['status' => Status::Requested->value]);

        $this->withoutExceptionHandling()
            ->patchJson(
                route('travel-request.update-status', $travelRequest->id),
                ['status' => Status::Requested->value]
            );
    }

    public function test_notify_user()
    {
        Notification::fake();

        $travelRequest = TravelRequest::factory()->create(['status' => Status::Requested->value]);

        $this->patchJson(
            route('travel-request.update-status', $travelRequest->id),
            ['status' => Status::Approved->value]
        );

        Notification::assertSentTo($travelRequest->user, TravelRequestUpdated::class);
    }
}

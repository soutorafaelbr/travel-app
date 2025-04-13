<?php

namespace Tests\Feature;

use App\Domain\TravelOrder\Enums\Status;
use App\Models\TravelOrder;
use App\Models\User;
use App\Notifications\TravelOrderUpdated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('update')]
class UpdateTravelOrderStatusTest extends TestCase
{
    private User $loggedUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->loggedUser = User::factory()->create());
    }

    public function test_updates_status(): void
    {
        $travelOrder = TravelOrder::factory()->create();

        $this->patchJson(
            route('travel-order.update-status', $travelOrder->id),
            ['status' => Status::Approved->value]
        );

        $this->assertDatabaseHas(
            TravelOrder::class,
            ['status' => Status::Approved->value, 'id' => $travelOrder->id]
        );
    }

    public function test_responds_with_no_content_status(): void
    {
        $travelOrder = TravelOrder::factory()->create();

        $this->patchJson(
            route('travel-order.update-status', $travelOrder->id),
            ['status' => Status::Approved->value]
        )->assertNoContent();
    }

    public function test_status_must_be_valid(): void
    {
        $travelOrder = TravelOrder::factory()->create();

        $this->patchJson(
            route('travel-order.update-status', $travelOrder->id),
            ['status' => 'invalid-status']
        )->assertJsonValidationErrors('status');
    }

    public function test_approved_travel_request_cannot_be_canceled()
    {
        $this->expectException(ValidationException::class);
        $travelOrder = TravelOrder::factory()->create(['status' => Status::Approved->value]);

        $this->withoutExceptionHandling()
            ->patchJson(
                route('travel-order.update-status', $travelOrder->id),
                ['status' => Status::Canceled->value]
            );
    }

    public function test_canceled_travel_request_cannot_be_approved()
    {
        $this->expectException(ValidationException::class);
        $travelOrder = TravelOrder::factory()->create(['status' => Status::Canceled->value]);

        $this->withoutExceptionHandling()
            ->patchJson(
                route('travel-order.update-status', $travelOrder->id),
                ['status' => Status::Approved->value]
            );
    }

    public function test_requested_travel_request_cannot_be_requested()
    {
        $this->expectException(ValidationException::class);
        $travelOrder = TravelOrder::factory()->create(['status' => Status::Requested->value]);

        $this->withoutExceptionHandling()
            ->patchJson(
                route('travel-order.update-status', $travelOrder->id),
                ['status' => Status::Requested->value]
            );
    }

    public function test_notify_user()
    {
        Notification::fake();

        $travelOrder = TravelOrder::factory()->create(['status' => Status::Requested->value]);

        $this->patchJson(
            route('travel-order.update-status', $travelOrder->id),
            ['status' => Status::Approved->value]
        );

        Notification::assertSentTo($travelOrder->user, TravelOrderUpdated::class);
    }
}

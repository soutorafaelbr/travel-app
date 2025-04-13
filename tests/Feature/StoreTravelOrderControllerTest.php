<?php

namespace Tests\Feature;

use App\Models\TravelOrder;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('store')]
class StoreTravelOrderControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($loggedUser = User::factory()->create());
        $this->travelOrder = TravelOrder::factory()->make(['user_id' => $loggedUser->id]);
    }

    public function test_store_travel_request_responds_with_http_created_code()
    {
        $this->postJson(route('travel-order.store'), $this->travelOrder->toArray())
            ->assertStatus(JsonResponse::HTTP_CREATED);
    }

    public function test_store_travel_request_responds_data()
    {
        $this->postJson(route('travel-order.store'), $this->travelOrder->toArray())
            ->assertJsonFragment($this->travelOrder->toArray());
    }

    public function test_store_travel_request()
    {
        $this->postJson(route('travel-order.store'), $this->travelOrder->toArray());

        $this->assertDatabaseHas(
            TravelOrder::class,
            [
                'user_id' => $this->travelOrder->user_id,
                'applicant_name' => $this->travelOrder->applicant_name,
                'status' => $this->travelOrder->status,
                'departure_date' => $this->travelOrder->departure_date,
                'return_date' => $this->travelOrder->return_date,
                'destination' => $this->travelOrder->destination,
            ]
        );
    }

    public function test_requires_all_fields_to_create_a_travel_request()
    {
        $response = $this->postJson(route('travel-order.store'));

        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                'destination',
                'departure_date',
                'return_date',
            ]);
    }

    public function test_requires_valid_date_format()
    {
        $response = $this->postJson(route('travel-order.store'), [
            'destination' => 'Nova York',
            'departure_date' => 'not-a-date',
            'return_date' => 'also-not-a-date',
        ]);

        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                'departure_date',
                'return_date',
            ]);
    }

    public function test_return_date_must_be_after_departure_date()
    {
        $response = $this->postJson(route('travel-order.store'), [
            'destination' => 'Paris',
            'departure_date' => '2025-06-10',
            'return_date' => '2025-06-05',
        ]);

        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                'return_date',
            ]);
    }

    public function test_status_must_be_required()
    {
        $response = $this->postJson(route('travel-order.store'), [
            'destination' => 'Paris',
            'departure_date' => '2025-06-10',
            'return_date' => '2025-06-05',
        ]);

        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                'status',
            ]);
    }

    public function test_status_must_be_valid()
    {
        $response = $this->postJson(route('travel-order.store'), [
            'destination' => 'Paris',
            'departure_date' => '2025-06-10',
            'return_date' => '2025-06-05',
            'status' => 'invalid-status',
        ]);

        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                'status',
            ]);
    }

    public function test_applicant_name_must_be_required()
    {
        $response = $this->postJson(route('travel-order.store'), [
            'destination' => 'Paris',
            'departure_date' => '2025-06-10',
            'return_date' => '2025-06-05',
            'status' => 'invalid-status',
        ]);

        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                'applicant_name',
            ]);
    }
}

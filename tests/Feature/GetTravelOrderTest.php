<?php

namespace Tests\Feature;

use App\Domain\TravelOrder\Enums\Status;
use App\Models\TravelOrder;
use App\Models\User;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('get')]
class GetTravelOrderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($loggedUser = User::factory()->create());
        $this->travelOrder = TravelOrder::factory()->create(['user_id' => $loggedUser->id]);
    }

    public function test_responds_with_http_ok(): void
    {
        $this->get(route('travel-order.get'))->assertOk();
    }

    public function test_responds_with_travel_requests(): void
    {
        $this->getJson(route('travel-order.get'))
            ->assertJsonFragment($this->travelOrder->toArray());
    }

    public function test_responds_with_filtered_travel_by_status_request(): void
    {
        TravelOrder::factory()
            ->create(['user_id' => $this->travelOrder->user_id, 'status' => Status::Approved->value]);

        $this->getJson(route('travel-order.get', ['status' => Status::Approved->value]))
            ->assertJsonFragment(['status' => Status::Approved->value]);
    }

    public function test_responds_validation_json_given_invalid_status(): void
    {
        TravelOrder::factory()
            ->create(['user_id' => $this->travelOrder->user_id, 'status' => Status::Approved->value]);

        $this->getJson(route('travel-order.get', ['status' => 'invalid-status']))
            ->assertJsonValidationErrors('status');
    }

    public function test_responds_empty_list_when_theres_no_match_for_status_filter(): void
    {
        TravelOrder::factory()
            ->create(['user_id' => $this->travelOrder->user_id, 'status' => Status::Approved->value]);

        $this->getJson(route('travel-order.get', ['status' => Status::Canceled->value]))
            ->assertExactJson([]);
    }

    public function test_responds_with_filtered_travel_by_destination_request(): void
    {
        $city = 'New York';

        TravelOrder::factory()
            ->create(['user_id' => $this->travelOrder->user_id, 'destination' => $city]);

        $this->getJson(route('travel-order.get', ['destination' => $city]))
            ->assertJsonFragment(['destination' => $city]);
    }

    public function test_responds_with_empty_list_when_theres_no_match_for_destination_filter(): void
    {
        $city = 'Los Angeles';

        TravelOrder::factory()
            ->create(['user_id' => $this->travelOrder->user_id]);

        $this->getJson(route('travel-order.get', ['destination' => $city]))
            ->assertExactJson([]);
    }

    public function test_responds_with_filtered_travel_by_date_range_request(): void
    {
        $from = now()->addDay()->toDateString();
        $to = now()->addWeek()->toDateString();
        $departureDate = now()->addDays(3)->startOfDay();

        TravelOrder::factory()
            ->create(['user_id' => $this->travelOrder->user_id, 'departure_date' => $departureDate]);

        $this->getJson(route('travel-order.get', ['from' => $from, 'to' => $to]))
            ->assertJsonFragment(['departure_date' => $departureDate]);
    }

    public function test_responds_with_empty_list_when_there_is_no_match_for_filter(): void
    {
        $from = now()->addDays(2)->toDateString();
        $to = now()->addWeek()->toDateString();
        $departureDate = now()->addDays(9);

        TravelOrder::factory()
            ->create(['user_id' => $this->travelOrder->user_id, 'departure_date' => $departureDate]);

        $this->getJson(route('travel-order.get', ['from' => $from, 'to' => $to]))
            ->assertExactJson([]);
    }
}

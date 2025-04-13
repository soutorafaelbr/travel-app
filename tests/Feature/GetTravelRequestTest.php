<?php

namespace Tests\Feature;

use App\Domain\TravelRequest\Enums\Status;
use App\Models\TravelRequest;
use App\Models\User;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('get')]
class GetTravelRequestTest extends TestCase
{
    protected function setUp(): void
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

    public function test_responds_with_filtered_travel_by_status_request(): void
    {
        TravelRequest::factory()
            ->create(['user_id' => $this->travelRequest->user_id, 'status' => Status::Approved->value]);

        $this->getJson(route('travel-request.get', ['status' => Status::Approved->value]))
            ->assertJsonFragment(['status' => Status::Approved->value]);
    }

    public function test_responds_validation_json_given_invalid_status(): void
    {
        TravelRequest::factory()
            ->create(['user_id' => $this->travelRequest->user_id, 'status' => Status::Approved->value]);

        $this->getJson(route('travel-request.get', ['status' => 'invalid-status']))
            ->assertJsonValidationErrors('status');
    }

    public function test_responds_empty_list_when_theres_no_match_for_status_filter(): void
    {
        TravelRequest::factory()
            ->create(['user_id' => $this->travelRequest->user_id, 'status' => Status::Approved->value]);

        $this->getJson(route('travel-request.get', ['status' => Status::Canceled->value]))
            ->assertExactJson([]);
    }

    public function test_responds_with_filtered_travel_by_destination_request(): void
    {
        $city = 'New York';

        TravelRequest::factory()
            ->create(['user_id' => $this->travelRequest->user_id, 'destination' => $city]);

        $this->getJson(route('travel-request.get', ['destination' => $city]))
            ->assertJsonFragment(['destination' => $city]);
    }

    public function test_responds_with_empty_list_when_theres_no_match_for_destination_filter(): void
    {
        $city = 'Los Angeles';

        TravelRequest::factory()
            ->create(['user_id' => $this->travelRequest->user_id]);

        $this->getJson(route('travel-request.get', ['destination' => $city]))
            ->assertExactJson([]);
    }

    public function test_responds_with_filtered_travel_by_date_range_request(): void
    {
        $from = now()->addDay()->toDateString();
        $to = now()->addWeek()->toDateString();
        $departureDate = now()->addDays(3)->startOfDay();

        TravelRequest::factory()
            ->create(['user_id' => $this->travelRequest->user_id, 'departure_date' => $departureDate]);

        $this->getJson(route('travel-request.get', ['from' => $from, 'to' => $to]))
            ->assertJsonFragment(['departure_date' => $departureDate]);
    }

    public function test_responds_with_empty_list_when_there_is_no_match_for_filter(): void
    {
        $from = now()->addDays(2)->toDateString();
        $to = now()->addWeek()->toDateString();
        $departureDate = now()->addDays(9);

        TravelRequest::factory()
            ->create(['user_id' => $this->travelRequest->user_id, 'departure_date' => $departureDate]);

        $this->getJson(route('travel-request.get', ['from' => $from, 'to' => $to]))
            ->assertExactJson([]);
    }
}

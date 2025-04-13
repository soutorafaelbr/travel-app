<?php

namespace App\Domain\TravelRequest\Services;

use App\Domain\TravelRequest\DTOs\TransitionStatusDTO;
use App\Domain\TravelRequest\DTOs\UpdateTravelRequestStatusDTO;
use App\Domain\TravelRequest\Enums\Status;
use App\Domain\TravelRequest\Repositories\TravelRequestRepository;
use Illuminate\Validation\ValidationException;

class UpdateTravelRequestStatusService
{
    public function __construct(
        private readonly TravelRequestRepository $repository,
        private readonly TravelRequestStateMachine $stateMachine
    ) {}

    public function handle(UpdateTravelRequestStatusDTO $DTO): void
    {
        $travelRequest = $this->repository->findOrFail($DTO->id);

        $this->stateMachine->handle(new TransitionStatusDTO($travelRequest->status, $DTO->status));

        $this->repository->update($travelRequest->id, ['status' => $DTO->status]);
    }
}

<?php

namespace App\Domain\TravelRequest\Services;

use App\Domain\TravelRequest\DTOs\TransitionStatusDTO;
use App\Domain\TravelRequest\DTOs\UpdateTravelRequestStatusDTO;
use App\Domain\TravelRequest\Repositories\TravelRequestRepository;
use App\Notifications\TravelRequestUpdated;

class UpdateTravelRequestStatusService
{
    public function __construct(
        private readonly TravelRequestRepository $repository,
        private readonly TravelRequestStateMachine $stateMachine
    ) {}

    public function handle(UpdateTravelRequestStatusDTO $DTO): void
    {
        $travelRequest = $this->repository->findOrFail($DTO->id);

        $transitionDTO = new TransitionStatusDTO($travelRequest->status, $DTO->status);

        $this->stateMachine->handle($transitionDTO);

        $this->repository->update($travelRequest->id, ['status' => $DTO->status]);

        $travelRequest->user->notify(new TravelRequestUpdated($travelRequest, $transitionDTO));
    }
}

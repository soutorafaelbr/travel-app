<?php

namespace App\Domain\TravelOrder\Services;

use App\Domain\TravelOrder\DTOs\TransitionStatusDTO;
use App\Domain\TravelOrder\DTOs\UpdateTravelOrderStatusDTO;
use App\Domain\TravelOrder\Repositories\TravelOrderRepository;
use App\Notifications\TravelOrderUpdated;

class UpdateTravelOrderStatusService
{
    public function __construct(
        private readonly TravelOrderRepository $repository,
        private readonly TravelOrderStateMachine $stateMachine
    ) {}

    public function handle(UpdateTravelOrderStatusDTO $DTO): void
    {
        $travelOrder = $this->repository->findOrFail($DTO->id);

        $transitionDTO = new TransitionStatusDTO($travelOrder->status, $DTO->status);

        $this->stateMachine->handle($transitionDTO);

        $this->repository->update($travelOrder->id, ['status' => $DTO->status]);

        $travelOrder->user->notify(new TravelOrderUpdated($travelOrder, $transitionDTO));
    }
}

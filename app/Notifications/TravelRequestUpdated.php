<?php

namespace App\Notifications;

use App\Domain\TravelRequest\DTOs\TransitionStatusDTO;
use App\Models\TravelRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class TravelRequestUpdated extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        private readonly TravelRequest $travelRequest,
        private readonly TransitionStatusDTO $transitionStatusDTO
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line("Your travel request has been updated from {$this->transitionStatusDTO->from->value} to {$this->transitionStatusDTO->to->value}")
            ->line('Thank you for using our application!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

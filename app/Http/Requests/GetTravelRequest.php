<?php

namespace App\Http\Requests;

use App\Domain\TravelRequest\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class GetTravelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'to' => 'sometimes|date',
            'from' => 'sometimes|date',
            'status' => ['sometimes', new Enum(Status::class)],
            'destination' => 'sometimes|string',
        ];
    }
}

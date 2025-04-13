<?php

namespace App\Http\Requests;

use App\Domain\TravelOrder\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class GetTravelOrderRequest extends FormRequest
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

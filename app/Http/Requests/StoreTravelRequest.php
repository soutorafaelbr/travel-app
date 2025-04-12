<?php

namespace App\Http\Requests;

use App\Domain\TravelRequest\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTravelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'applicant_name' => 'required|string',
            'destination' => 'required|string',
            'departure_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:departure_date',
            'status' => [
                'required',
                new Enum(Status::class)
            ],
        ];
    }
}

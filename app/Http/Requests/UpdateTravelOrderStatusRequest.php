<?php

namespace App\Http\Requests;

use App\Domain\TravelOrder\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateTravelOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', new Enum(Status::class)],
        ];
    }
}

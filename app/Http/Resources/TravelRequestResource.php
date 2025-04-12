<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'applicant_name' => $this->applicant_name,
                'destination' => $this->destination,
                'status' => $this->status,
                'departure_date' => $this->departure_date,
                'return_date' => $this->return_date,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}

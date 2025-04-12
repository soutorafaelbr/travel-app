<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelRequest extends Model
{
    /** @use HasFactory<\Database\Factories\TravelRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'applicant_name',
        'status',
        'departure_date',
        'return_date',
        'destination',
    ];

    protected $casts = [
        'departure_date' => 'datetime',
        'return_date' => 'datetime',
    ];
}

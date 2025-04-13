<?php

namespace App\Models;

use App\Domain\TravelRequest\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TravelRequest extends Model
{
    /** @use HasFactory<\Database\Factories\TravelRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'applicant_name',
        'status',
        'departure_date',
        'return_date',
        'destination',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
        'status' => Status::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

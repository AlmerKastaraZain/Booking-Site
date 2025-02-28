<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoomType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'rental_id',
        'price',
        'wide',
        'adult',
        'child',
        'bed',
        'can_smoke',
    ];

    public function Service()
    {
        return $this->hasMany(RoomService::class);
    }

    public function RoomFacility()
    {
        return $this->hasMany(RoomFacilities::class);
    }

    public function RentalId(): HasOne
    {
        return $this->HasOne(Rental::class, 'id', 'rental_id');
    }
}

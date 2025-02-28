<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    //
    protected $fillable = [
        'name',
        'rental_id',
        'room_type_id',
    ];

    public function RentalId(): HasOne
    {
        return $this->HasOne(Rental::class, 'id', 'rental_id');
    }

    public function RoomTypeId(): HasOne
    {
        return $this->HasOne(RoomType::class, 'id', 'room_type_id');
    }

}

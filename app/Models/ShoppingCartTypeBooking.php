<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ShoppingCartTypeBooking extends Model
{
    protected $fillable = [
        'rental_id',
        'room_type_id',
        'amount',
        'user_id',
        'child',
        'check_in',
        'check_out',
    ];


    public function RentalId(): HasOne
    {
        return $this->HasOne(Rental::class, 'id', 'rental_id');
    }

    public function RoomTypeId(): HasOne
    {
        return $this->HasOne(RoomType::class, 'id', 'room_type_id');
    }

    public function UserId(): HasOne
    {
        return $this->HasOne(Rental::class, 'id', 'user_id');
    }
}

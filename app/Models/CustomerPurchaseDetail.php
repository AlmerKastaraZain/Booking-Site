<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomerPurchaseDetail extends Model
{
    protected $fillable = [
        'purchase_id',
        'user_id',
        'rental_id',
        'room_type_id',
        'item_name',
        'price',
        'amount',
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
        return $this->HasOne(RoomType::class, 'id', 'user_id');
    }

}

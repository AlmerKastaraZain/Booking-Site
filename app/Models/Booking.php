<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    //
    protected $fillable = [
        'rental_id',
        'room_type_id',
        'room_id',
        'check_in',
        'check_out',
        'user_id',
        'team_id',
    ];

    public function UserId(): HasOne
    {
        return $this->HasOne(User::class,'id', 'user_id' );
    }


    public function TeamId(): HasOne
    {
        return $this->HasOne(Team::class, 'id', 'team_id');
    }

    public function RoomTypeId(): HasOne
    {
        return $this->HasOne(RoomType::class, 'id', 'room_type_id');
    }

    public function RentalId(): HasOne
    {
        return $this->HasOne(Rental::class, 'id', 'rental_id');
    }

    public function RoomId(): HasOne
    {
        return $this->HasOne(Room::class, 'id', 'room_id');
    }
}

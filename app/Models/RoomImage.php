<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomImage extends Model
{
    use HasFactory; 
    //
    protected $fillable = [
        'rental_id',
        'room_id',
        'title',
        'src'
    ];


    public function users(): BelongsTo
    {
        return $this->BelongsTo(Room::class);
    }


    public function RentalId(): BelongsTo
    {
        return $this->BelongsTo(Rental::class, 'id', 'room_id');
    }

    public function RoomId(): BelongsTo
    {
        return $this->BelongsTo(RoomType::class, 'id', 'room_id');
    }
}


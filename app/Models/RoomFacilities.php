<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoomFacilities extends Model
{
    //
    protected $fillable = [
        'rental_id',
        'room_type_id',
        'room_facility_id',
    ];
    public function RentalId(): hasOne
    {
        return $this->hasOne(Rental::class, 'id', 'rental_id');
    }
    public function RoomTypeId(): hasOne
    {
        return $this->hasOne(RoomType::class, 'id', 'room_type_id');
    }

    public function RoomFacilityId(): HasOne
    {
        return $this->hasOne(RoomFacilitiesFeature::class, 'id', 'room_facility_id');
    }
}

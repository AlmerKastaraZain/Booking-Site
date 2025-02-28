<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rental extends Model
{
    //

    protected $fillable = [
        'name',
        'property_type_id',
        'team_id',
        'description',
        'phone_number',

        // Maps
        'country',
        'status_id',

        'administrative_area_level_1',
        'administrative_area_level_2',
        'administrative_area_level_3',
        'administrative_area_level_4',
        'administrative_area_level_5',
        'administrative_area_level_6',
        'administrative_area_level_7',

        'locality',
        'postal_code',
        'street_address',
        'full_address',
        'route',

        'latitude',
        'longitude',
    ];

    public function StatusId(): HasOne
    {
        return $this->HasOne(Status::class, 'id', 'status_id');
    }


    public function RoomType()
    {
        return $this->hasMany(RoomType::class);
    }

    public function Facility()
    {
        return $this->hasMany(Facilities::class);
    }

    public function Service()
    {
        return $this->hasMany(RoomService::class);
    }

    public function RoomFacility()
    {
        return $this->hasMany(RoomFacilities::class);
    }

    public function Bookings()
    {
        return $this->hasMany(Booking::class);
    }


    public function PropertyTypeId(): HasOne
    {
        return $this->HasOne(PropertyType::class, 'id', 'property_type_id');
    }


    public function TeamId(): HasOne
    {
        return $this->HasOne(Team::class, 'id', 'team_id');
    }
}

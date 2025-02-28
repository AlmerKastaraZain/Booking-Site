<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Facilities extends Model
{
    //
    protected $fillable = [
        'rental_id',
        'rental_facility',
    ];

    public function RentalId(): HasOne
    {
        return $this->HasOne(Rental::class, 'id', 'rental_id');
    }


    public function RentalFacilityId(): HasOne
    {
        return $this->HasOne(FacilitiesFeature::class, 'id', 'rental_facility');
    }
}

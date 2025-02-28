<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class RentalImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'title',
        'src'
    ];


    public function RentalId(): BelongsTo
    {
        return $this->BelongsTo(Rental::class);
    }
}

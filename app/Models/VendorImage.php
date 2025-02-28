<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VendorImage extends Model
{
    protected $fillable = [
        'team_id',
        'title',
        'src'
    ];

    public function StatusId(): HasOne
    {
        return $this->HasOne(Team::class, 'id', 'team_id');
    }
}

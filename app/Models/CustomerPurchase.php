<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomerPurchase extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'receipt_url',
    ];
    public function UserId(): HasOne
    {
        return $this->HasOne(RoomType::class, 'id', 'user_id');
    }


}

<?php

namespace App\Models;

use Lanos\CashierConnect\ConnectCustomer;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    
    use ConnectCustomer;
   
}

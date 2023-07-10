<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    public function PaymentFrom()
    {
        return $this->belongsTo(\App\Models\Accounts\CashAccounts::class,'payment_from');
    }

    
}

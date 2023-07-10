<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAccountDeposit extends Model
{
    use HasFactory;

    public function AccountName()
    {
        return $this->belongsTo(CashAccounts::class,'account_id');
    }
}

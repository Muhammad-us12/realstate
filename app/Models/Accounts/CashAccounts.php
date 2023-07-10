<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAccounts extends Model
{
    use HasFactory;

    protected $fillable = ['account_name','account_number'];

    public function AccountBalance()
    {
        return $this->hasOne(CashAccountsBal::class,'account_id');
    }
}

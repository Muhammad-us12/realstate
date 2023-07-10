<?php

namespace App\Models\persons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyers extends Model
{
    use HasFactory;

    protected $fillable = ['fname','lname','buyer_type','email','CNIC','picture','country','city','phone','address'];

    public function BuyerBalance()
    {
        return $this->hasOne(BuyerBalance::class,'buyer_id');
    }
}

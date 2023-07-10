<?php

namespace App\Models\persons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = ['custfname','custlname','customer_type','email','CNIC','picture','country','city','phone','address'];

    public function CustomerBalance()
    {
        return $this->hasOne(CustomerBalance::class,'customer_id');
    }
}

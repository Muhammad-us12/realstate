<?php

namespace App\Models\website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffersCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name'];

    public function CategoryOffers()
    {
        return $this->hasMany(Offers::class,'offer_category');
    }

    public function OffersCount()
    {
        return $this->CategoryOffers->count()?? 0;
    }
}

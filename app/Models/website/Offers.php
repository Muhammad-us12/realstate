<?php

namespace App\Models\website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;

    protected $fillable = ['title','picture','status','short_description','description','offer_category','offer_location'];

    public function OfferCategory()
    {
        return $this->belongsTo(OffersCategory::class,'offer_category');
    }

    public function OfferLocation()
    {
        return $this->belongsTo(\App\Models\Location::class,'offer_location');
    }
}

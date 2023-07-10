<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = ['location_name','picture','description'];

    public function locationSocieties()
    {
        return $this->hasMany(locations\Societies::class,'location');
    }

}

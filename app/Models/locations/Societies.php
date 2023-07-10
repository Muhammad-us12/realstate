<?php

namespace App\Models\locations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societies extends Model
{
    use HasFactory;
    protected $fillable = ['society_name','picture','description','location','display_on_web'];

    public function SocietyLocation()
    {
        return $this->belongsTo(\App\Models\Location::class,'location');
    }
}


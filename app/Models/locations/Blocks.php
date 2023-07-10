<?php

namespace App\Models\locations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blocks extends Model
{
    use HasFactory;

    protected $fillable = ['block_name','scoiety'];

    public function BlockSociety()
    {
        return $this->belongsTo(\App\Models\locations\Societies::class,'scoiety');
    }
}

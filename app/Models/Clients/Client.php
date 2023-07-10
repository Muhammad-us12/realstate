<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['status','updated_by','update_by_id','assign_to'];

    public function assignTo()
    {
        return $this->belongsTo(\App\Models\persons\Agent::class,'assign_to');
    }
}

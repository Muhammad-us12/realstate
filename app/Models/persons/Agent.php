<?php

namespace App\Models\persons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Agent extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['fname','lname','email','password','picture','country','city','phone','address','status','display_on_web'];

    public function AgentBalance()
    {
        return $this->hasOne(AgentBalance::class,'agent_id');
    }
}

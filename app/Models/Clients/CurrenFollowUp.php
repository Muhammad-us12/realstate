<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrenFollowUp extends Model
{
    protected $fillable = ['status'];
    use HasFactory;
}

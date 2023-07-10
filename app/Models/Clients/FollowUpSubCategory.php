<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpSubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['exp_sub_category','category_id'];

    public function categoryOf()
    {
        return $this->belongsTo(\App\Models\Clients\FollowUpCategory::class,'category_id');
    }
}

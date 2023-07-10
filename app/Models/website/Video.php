<?php

namespace App\Models\website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title','status','video_link','description','video_category','scoiety_id'];

    public function VideoCategory()
    {
        return $this->belongsTo(VideoCategory::class,'video_category');
    }

    public function OfferSociety()
    {
        return $this->belongsTo(\App\Models\locations\Societies::class,'scoiety_id');
    }
}

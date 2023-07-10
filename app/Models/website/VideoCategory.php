<?php

namespace App\Models\website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_name'];

    public function CategoryVideo()
    {
        return $this->hasMany(Video::class,'video_category');
    }

    public function VideoCount()
    {
        return $this->CategoryVideo->count()?? 0;
    }

}

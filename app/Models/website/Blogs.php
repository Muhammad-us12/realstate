<?php

namespace App\Models\website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;
    protected $fillable = ['title','picture','status','short_description','description','blog_category'];

    public function BlogCategory()
    {
        return $this->belongsTo(BlogCategory::class,'blog_category');
    }
}

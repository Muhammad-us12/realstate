<?php

namespace App\Models\website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_name'];

    public function CategoryBlogs()
    {
        return $this->hasMany(Blogs::class,'blog_category');
    }



    public function blogsCount()
    {
        return $this->CategoryBlogs->count()?? 0;
    }
}

<?php

namespace App\Models\admin\pages\blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogSetup extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
        'title',
        'slug',
        'content',
        'image',
        'author',
        'is_published',

    ];
}

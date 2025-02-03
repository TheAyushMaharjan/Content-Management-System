<?php

namespace App\Models\admin\pages\media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;
    protected $fillable =[
        'gallery_category',
        'content',
        'is_published',
    ];
}

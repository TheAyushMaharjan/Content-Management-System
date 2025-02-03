<?php

namespace App\Models\admin\pages\media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GallerySetup extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
        'title',
        'slug',
        'content',
        'image',
        'is_published',

    ];
}

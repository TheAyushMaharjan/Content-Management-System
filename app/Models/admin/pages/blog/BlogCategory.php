<?php

namespace App\Models\admin\pages\blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
   use HasFactory;
   protected $fillable = [
    'category_name',
    'icon_name',
    'description',
    'is_published',
   ];
}

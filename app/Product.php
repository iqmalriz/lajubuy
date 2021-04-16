<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'stock', 'image', 'imagebinary', 'video', 'videobinary', 'audio', 'audiobinary', 'document', 'documentbinary', 'comment'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Menu extends Model
{
    protected $fillable = ['category_id', 'name', 'price', 'image', 'isAvailable', 'classes', 'user_id', 'GPA', 'comment'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}

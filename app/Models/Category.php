<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_category', 'id');
    }
    public function childs()
    {
        return $this->hasMany('App\Models\Category', 'parent_category', 'id');
    }

    public static function allMainCategoriesWithChildren()
    {
        return self::whereNull('parent_category')->with('childs')->select('id', 'category_name', 'category_name_ar', 'parent_category', 'image')->get();
    }
}

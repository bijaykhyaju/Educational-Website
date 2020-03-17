<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public static function getAllCategories(){
        return Category::where('publish','1')->get();
    }
}

//Tinker adding Data

// $cat = new App\Category;
// $cat->name = "Reading";
// $cat->parent_id = "0";
// $cat->order = "1";
// $cat->publish = "1";
// $cat->save();

// $cat = new App\Category;
// $cat->name = "Writing";
// $cat->parent_id = "0";
// $cat->order = "2";
// $cat->publish = "1";
// $cat->save();

// $cat = new App\Category;
// $cat->name = "Counting";
// $cat->parent_id = "0";
// $cat->order = "3";
// $cat->publish = "1";
// $cat->save();

// $cat = new App\Category;
// $cat->name = "English";
// $cat->parent_id = "0";
// $cat->order = "4";
// $cat->publish = "1";
// $cat->save();


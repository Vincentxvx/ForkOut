<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostManagement extends Model
{
    public static function ingredientSearch($searchText)
    {
        return DB::select('SELECT * FROM ingredient WHERE ingredient.name LIKE ? OR ingredient.category LIKE ?', [$searchText, $searchText]);
    }
}


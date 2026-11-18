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
    public static function macroNutrients($id){
        return DB::selectOne('SELECT kcal_per_100g as kcal, protein_per_100g as protein, fat_per_100g as fat, carbs_per_100g as carbs FROM ingredient WHERE ingredient.ingredient_id = ?;', [$id]);
    }

    public static function recipe($userId, $name, $description,$filename, $prep_time, $nutrients){
        return DB::insert('INSERT INTO recipe (user_id, name, description, media_url, prep_time, created_at, status, calorie, protein, fat, carbs) VALUES (?,?, ?, ?, ?, NOW(), "Unverified", ?, ?, ?, ?);',[$userId, $name, $description, $filename, $prep_time, $nutrients['kcal'],$nutrients['protein'],$nutrients['fat'],$nutrients['carbs']]);
    }
    public static function recipe_ingredient($recipeID ,$ingredient_id, $quantity, $unit){
        return DB::insert('INSERT INTO recipe_ingredient (recipe_id, ingredient_id, amount, unit) VALUES (?, ?, ?, ?);',[$recipeID, $ingredient_id, $quantity, $unit]);
    }
}


<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
class Homepage
{
    public static function dailyCalories($userId, $date)
    {
        $rows = DB::select(
            'SELECT COALESCE(SUM(r.calorie * m.portion), 0) AS total_calories
             FROM meal m
             JOIN recipe r ON r.recipe_id = m.recipe_id
             WHERE m.user_id = ?
               AND m.`date` >= ?
               AND m.`date` < DATE_ADD(?, INTERVAL 1 DAY)',
            [$userId, $date, $date]
        );

        return (array) $rows[0];
    }
    public static function dailyMacros($userId, $date)
    {
        $rows = DB::select(
            'SELECT COALESCE(SUM(r.fat * m.portion), 0) AS total_fat, 
                    COALESCE(SUM(r.carbs * m.portion), 0) AS total_carbohydrate, 
                    COALESCE(SUM(r.protein * m.portion), 0) AS total_protein
             FROM meal m
             JOIN recipe r ON r.recipe_id = m.recipe_id
             WHERE m.user_id = ?
               AND m.`date` >= ?
               AND m.`date` < DATE_ADD(?, INTERVAL 1 DAY)',
            [$userId, $date, $date]
        );

        return (array) $rows;
    }
    public static function dailyMeals($userId, $date)
    {
        $rows = DB::select(
            'SELECT m.portion, m.date, r.name
             FROM meal m
             JOIN recipe r ON r.recipe_id = m.recipe_id
             WHERE m.user_id = ?
               AND m.`date` >= ?
               AND m.`date` < DATE_ADD(?, INTERVAL 1 DAY)',
            [$userId, $date, $date]
        );

        return (array) $rows;
        
    }
    
}
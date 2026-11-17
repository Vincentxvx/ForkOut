<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Homepage;

class HomepageController extends Controller
{
    public function dailyCalorie(Request $request)
    {
        $dailyCalorie = Homepage::dailyCalories($request->user()["user_id"], date('Y-m-d'));
        return response()->json(['daily_calorie' => $dailyCalorie]);

    }
    public function dailyMacros(Request $request)
    {
        $dailyMacros = Homepage::dailyMacros($request->user()["user_id"], date('Y-m-d'));
        return response()->json(['daily_macros' => array_map(function ($row) {
            return (array) $row;
        }, $dailyMacros)]);
    }
    public function dailyMeals(Request $request)
    {
        $dailyMeals = Homepage::dailyMeals($request->user()["user_id"], date('Y-m-d'));
        return response()->json(['daily_meals' => array_map(function ($row) {
            return (array) $row;
        }, $dailyMeals)]);
    }
    public function loadExcercises(Request $request)
    {
        $exercises = DB::select('SELECT * FROM exercise');
        return response()->json(['exercises' => array_map(function ($row) {
            return (array) $row;
        }, $exercises)]);
    }

}
?>
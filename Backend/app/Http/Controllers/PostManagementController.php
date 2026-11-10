<?php

namespace App\Http\Controllers;

use App\Models\PostManagement;
use Illuminate\Http\Request;

class PostManagementController extends Controller
{
    public function ingredient(Request $request){
        $searchText = $request-> json('searchText'); //I expect a {'searchText': 'some string'} structure
        if (empty($searchText)){
            return;
        }
        $result = PostManagement::ingredientSearch($searchText);
        return response()-> json($result);
    }
    public function upload(Request $request){
        $recipeData = $request -> all();
        /*I expect a data structure like this
        {
        "userID": userId,
        "name": recipeName,
        "description": description,
        "preptime": preptime,
        "dateOFCREATION": date,
        "imgURL": imageUrl,
        "ingredientId": [firstID, secondID...],
        "quantity":  [firstQUANTITY, sedondQUANTITY...],
        "unit" : [firstUNIT, secondUNIT...],
        "instructions": [firstINTSTRUCTION, secondINSTRUCTION...]

        }
        */
        /*
        First, I have to query every property of every ingredient, then sum the micronutrients. 
        Then I insert the recipe's data into the recipe table. 
        Then I connect the recipe with the ingredients (also uploading their quantites and unit of measurement).
        Then at last I insert the instructions into the database.
        */

    }
}
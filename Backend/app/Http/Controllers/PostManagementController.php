<?php

namespace App\Http\Controllers;

use App\Models\PostManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostManagementController extends Controller
{
    public function ingredient(Request $request){
        $searchText = $request-> json('searchText'); //I expect a {'searchText': 'some string'} structure
        if (empty($searchText)){
            return;
        }
        $result = PostManagement::ingredientSearch($searchText);
        return response()-> json($result,200);
    }

    
    public function upload(Request $request){
        $userId= user()['user_id']; 
        $userName = user()['username'];
        
    $validator = Validator::make($request->all(), [
        'name'        => 'required|string|max:100',
        'description' => 'nullable|string|max:2000',
        'prep_time'   => 'required|integer|min:1|max:1440',
        'image'       => 'required|image|mimes:jpg,jpeg,png|max:5120',

        'ingredients'                 => 'required|array|min:1',
        'ingredients.*.ingredient_id' => 'required|integer|distinct|exists:ingredients,id',
        'ingredients.*.quantity'      => 'required|numeric|gt:0',
        'ingredients.*.unit'          => 'required|in:g,ml', //unit managing is still under work

        'instructions'               => 'required|array|min:1',
        'instructions.*.instruction' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid recipe data','errors'  => $validator->errors(),], 422);
        }
        

        $data = $validator->validated();
        $nutrients = array("kcal"=>0, "protein"=>0, "fat"=>0,"carbs"=> 0 );
        foreach($data['ingredients'] as $ingredient){
            $result = PostManagement::macroNutrients($ingredient['ingredient_id']);
            $nutrients["kcal"] += $result["kcal"]/100*$ingredient['quantity'];
            $nutrients["protein"] += $result["protein"]/100*$ingredient['quantity'];
            $nutrients["fat"] += $result["fat"]/100*$ingredient['quantity'];
            $nutrients["carbs"] += $result["carbs"]/100*$ingredient['quantity'];
        }

        //image storing
        $path = $data['image']->store('uploads/recipes', 'public');
        //uploading recipe
        $recipeUpload = PostManagement::recipe($userId, $data['name'], $data['description'],$path, $data['prep_time'], $nutrients);
        $recipeID=$recipeUpload->$insert_id;

        //in case if an unsuccesful upload a response is required
        
        foreach($data['ingredients'] as $ingredient){
            $result = PostManagement::recipe_ingredient($recipeID ,$ingredient['ingredient_id'], $ingredient['quantity'], $ingredient['unit']);
        }
        //in case if an unsuccesful upload a response is required
        foreach($data['instructions'] as $instruction){
            $result = PostManagement::recipe_instruction($recipeID , $instruction,);
        }


        /*I expect a data structure like this
        {
            "name": recipeName,
            "description": description,
            "prep_time": preptime,
            "imgUrl": imageUrl,
            "ingredients":[
                {
                    "ingredient_id": ID,
                    "quantity":  QUANTITY,
                    "unit" : UNIT
                },
                {
                    "ingredientId": ID,
                    "quantity":  QUANTITY,
                    "unit" : UNIT
                }
            ],
            "instructions": [
                        {
                            "instruction": "instruction"
                        },
                        {
                            "instruction": "instruction"
                        }
            ]
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
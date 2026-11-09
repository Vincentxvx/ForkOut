<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:100|unique:user,username',
            'email'    => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The provided data is incorrect.', 'errors' => $validator->errors()], 400);
        }

        $username = $request->input('username');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $existingUser = Auth::checkUser($username, $email);

        if (!empty($existingUser)) {
            return response()->json(['message' => 'The username or email is already taken.'], 400);
        }

        $createdUser = Auth::createUser($username, $email, $password);
        if (!$createdUser) {
            return response()->json(['message' => 'An error occurred while creating the user.'], 500);
        }else{
            return response()->json(['message' => 'The user was created successfully.'], 201);
        }
    }
    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The provided data is incorrect.', 'errors' => $validator->errors()], 400);
        }

        $username = $request->input('username');
        $password = $request->input('password');

        $user = Auth::checkUser($username, null);

        if (empty($user)) {
            return response()->json(['message' => 'Invalid username or password.'], 401);
        }

        if (!Hash::check($password, $user[0]->password_hash)) {
            return response()->json(['message' => 'Invalid username or password.'], 401);
        }
        return response()->json(['message' => 'Login successful.'], 200);
        function deleteUser($username)
        {
            $deleted = Auth::deleteUser($username);
            if ($deleted) {
                return response()->json(['message' => 'The user was deleted successfully.'], 200);
            } else {
                return response()->json(['message' => 'An error occurred while deleting the user.'], 500);
            }
        }
    }
}

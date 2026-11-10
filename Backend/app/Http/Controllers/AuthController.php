<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validáljuk a beérkező adatokat
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:100|unique:user,username',
            'email'    => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The provided data is incorrect.', 'errors' => $validator->errors()], 400);
        }

        $createdUser = User::create([
    'username'      => $request->input('username'),
    'email'         => $request->input('email'),
    'password_hash' => Hash::make($request->input('password')),
]);

        if (!$createdUser) {
            return response()->json(['message' => 'An error occurred while creating the user.'], 500);
        }

        return response()->json(['message' => 'The user was created successfully.'], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The provided data is incorrect.', 'errors' => $validator->errors()], 400);
        }
        // Ellenőrizzük, hogy a felhasználó létezik-e az adat
        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password_hash)) {
            return response()->json(['message' => 'Invalid login details.'], 401);
        }
        //bejelentkezés után token generálása ami a felhasználóhoz lesz kötve és a kliensnek visszaadjuk    
        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'token'   => $token,
            'user'    => $user
        ], 200);
    }

    public function logout(Request $request)
    {
        // A felhasználó aktuális hozzáférési tokenjének törlése a kijelentkezéshez
        $request->user()->currentAccessToken()->delete();
 
        return response()->json(['message' => 'Logout successful.'], 200);
    }
}
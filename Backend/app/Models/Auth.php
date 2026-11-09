<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Auth extends Model
{
    public static function checkUser($username, $email)
    {
        return DB::select('SELECT * FROM user WHERE username = ? OR email = ?', [$username, $email]);
    }
    public static function createUser($username, $email, $password)
    {
        return DB::insert('INSERT INTO user (username, email, password_hash) VALUES (?, ?, ?)', [$username, $email, $password]);
    }
    public static function deleteUser($username)
    {
        return DB::delete('DELETE FROM user WHERE username = ?', [$username]);
    }
}

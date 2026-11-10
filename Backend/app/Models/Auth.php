<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class Auth extends Authenticatable
{
public static function checkUser($username, $email)
    {
       $rows = DB::select(
'SELECT * FROM user WHERE username = ? OR email = ? LIMIT 1',[$username, $email]);

    return empty($rows) ? null : (array) $rows[0];
    }
    public static function createUser($username, $email, $password)
    {
        return DB::insert('INSERT INTO user (username, email, password_hash) VALUES (?, ?, ?)', [$username, $email, $password]);
    }
}
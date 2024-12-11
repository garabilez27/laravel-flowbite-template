<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'usr_id';
    public $timestamps = false;
    public $incrementing = false;

    public static function authenticate(array $credentials)
    {
        $user = self::where('usr_email', $credentials['email'])->with('role')->first();
        if(!$user || !Hash::check($credentials['password'], $user->usr_password))
        {
            return null;
        }

        return $user;
    }

    public function role()
    {
        return $this->belongsTo(Roles::class, 'rl_id', 'rl_id');
    }
}

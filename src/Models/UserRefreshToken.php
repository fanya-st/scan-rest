<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserRefreshToken extends Model
{
    protected $primaryKey = 'id';
    protected $table='users.user_refresh_token';
}
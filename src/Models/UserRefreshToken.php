<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserRefreshToken extends Model
{
    protected $primaryKey = 'id';
    protected $table='users.user_refresh_token';

    private $rules = array(
        'id' => 'required|int',
        'user_id'  => 'required|int|unique',
        // .. more rules here ..
    );

}
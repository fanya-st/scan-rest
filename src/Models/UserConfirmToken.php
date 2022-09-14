<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserConfirmToken extends Model
{
    protected $primaryKey = 'id';
    protected $table='users.user_confirm_token';
}
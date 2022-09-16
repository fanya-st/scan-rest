<?php


namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'id';
    protected $table='users.user';

    public static function findOne(int $id): Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return self::query()->find($id)->getModel();
    }

    public function verifyPassword(string $password)
    {
        if(!password_verify($password,$this->password_hash))
            return throw new \DomainException('Invalid email or password');
        return true;
    }



}
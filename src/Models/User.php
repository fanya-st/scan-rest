<?php


namespace App\Models;


use App\Object\Email;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity,Table(name:'user')]
class User
{
    private int $id;
    private Email $email;
    private string $password_hash;


    public function __construct(Email $email, string $password_hash){
        $this->email=$email;
        $this->password_hash=$password_hash;
    }


    public function getId(): int
    {
        return $this->id;
    }


}
<?php


namespace App\Object;


use http\Exception\InvalidArgumentException;

final class Email
{
    private string $email;

    public function __construct(string $email)
    {
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        throw new InvalidArgumentException('Incorrect Email');
    }
    if(empty($email)){
        throw new InvalidArgumentException('Empty Email');
    }

    $this->email = mb_strtolower($email);

    }

    public function getEmail(): string|null
    {
        return $this->email;
    }




}
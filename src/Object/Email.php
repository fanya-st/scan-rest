<?php


namespace App\Object;


class Email
{
    private string $email;

    public function __construct(string $email)
    {
        if(empty($email))
            return new \InvalidArgumentException('Empty email');

        $this->email=(string)mb_strtolower($email);

        return $this->email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
<?php

class CreateUserDTO
{
    public string $name;
    public string $email;
    public string $password;
    public string $symptoms;

    public function __construct(string $name, string $email, string $password, string $symptoms)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->symptoms = $symptoms;
    }
}

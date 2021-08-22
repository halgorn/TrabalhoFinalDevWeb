<?php

class UserAlreadyExistsError extends Error
{
    public function __construct() {
        $this->message = 'Usuário já cadastrado';
    }
}

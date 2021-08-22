<?php

class InvalidCredentialsError extends Error
{
    public function __construct() {
        $this->message = 'Credenciais inválidas';
    }
}

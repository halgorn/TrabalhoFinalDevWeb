<?php

class UserCreateError extends Error
{
    public function __construct() {
        $this->message = 'Erro ao cadastrar o usuário';
    }
}

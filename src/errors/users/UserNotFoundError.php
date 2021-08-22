<?php

class UserNotFoundError extends Error
{
    public function __construct() {
        $this->message = 'Usuário não encontrado';
    }
}

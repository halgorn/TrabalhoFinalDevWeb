<?php

class InvalidUserError extends Error
{
    public function __construct() {
        $this->message = 'Usuário inválido';
    }
}

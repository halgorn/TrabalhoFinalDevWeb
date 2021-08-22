<?php

interface IAutheticateUserRepository
{
    public function authenticateUser(AuthenticateUserDTO $authenticateUserDTO): int;
}

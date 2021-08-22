<?php

interface ICreateUserRepository
{
    public function createUser(CreateUserDTO $createUserDTO): UserModel;
}

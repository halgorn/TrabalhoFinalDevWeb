<?php

class CreateUserRepositoryFactory
{
    public static function make(): ICreateUserRepository
    {
        $hashAdapter = HashAdapterFactory::make();

        return new PDOCreateUserRepository($hashAdapter);
    }
}

<?php

class CreateUserControllerFactory
{
    public static function make(): CreateUserController
    {
        $createUserRepository = CreateUserRepositoryFactory::make();

        return new CreateUserController($createUserRepository);
    }
}

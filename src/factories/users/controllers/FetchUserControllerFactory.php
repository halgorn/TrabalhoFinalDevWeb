<?php

class FetchUserControllerFactory
{
    public static function make(): FetchUserController
    {
        $fetchUserRepository = FetchUserRepositoryFactory::make();

        return new FetchUserController($fetchUserRepository);
    }
}

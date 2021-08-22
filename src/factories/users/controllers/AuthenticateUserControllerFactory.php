<?php

class AuthenticateUserControllerFactory
{
    public static function make(): AuthenticateUserController
    {
        $authenticateUserRepository = AuthenticateUserRepositoryFactory::make();

        return new AuthenticateUserController($authenticateUserRepository);
    }
}

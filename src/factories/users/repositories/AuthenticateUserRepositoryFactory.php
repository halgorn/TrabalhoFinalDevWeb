<?php

class AuthenticateUserRepositoryFactory
{
    public static function make(): IAutheticateUserRepository
    {
        $hashAdapter = HashAdapterFactory::make();

        return new PDOAuthenticateUserRepository($hashAdapter);
    }
}

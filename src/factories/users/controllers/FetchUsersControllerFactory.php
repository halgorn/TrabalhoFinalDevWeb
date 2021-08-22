<?php

class FetchUsersControllerFactory
{
    public static function make(): FetchUsersController
    {
        $fetchUsersRepository = FetchUsersRepositoryFactory::make();

        return new FetchUsersController($fetchUsersRepository);
    }
}

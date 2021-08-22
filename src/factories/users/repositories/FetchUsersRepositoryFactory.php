<?php

class FetchUsersRepositoryFactory
{
    public static function make(): IFetchUsersRepository
    {
        $fetchUsersRepository = new PDOFetchUsersRepository();

        return $fetchUsersRepository;
    }
}

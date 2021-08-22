<?php

class FetchUserRepositoryFactory
{
    public static function make(): IFetchUserRepository
    {
        $fetchUserRepository = new PDOFetchUserRepository();

        return $fetchUserRepository;
    }
}

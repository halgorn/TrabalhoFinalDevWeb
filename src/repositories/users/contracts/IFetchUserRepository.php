<?php

interface IFetchUserRepository
{
    public function fetchUser(string $id): UserModel;
}

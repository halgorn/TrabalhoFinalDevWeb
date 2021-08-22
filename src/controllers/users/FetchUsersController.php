<?php

class FetchUsersController
{
    private IFetchUsersRepository $fetchUsersRepository;

    public function __construct(IFetchUsersRepository $fetchUsersRepository)
    {
        $this->fetchUsersRepository = $fetchUsersRepository;
    }

    public function handle(): array
    {
        return $this->fetchUsersRepository->fetchUsers();
    }
}

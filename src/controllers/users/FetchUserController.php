<?php

class FetchUserController
{
    private IFetchUserRepository $fetchUserRepository;

    public function __construct(IFetchUserRepository $fetchUserRepository)
    {
        $this->fetchUserRepository = $fetchUserRepository;
    }

    public function handle(string $id): UserModel
    {
        return $this->fetchUserRepository->fetchUser($id);
    }
}

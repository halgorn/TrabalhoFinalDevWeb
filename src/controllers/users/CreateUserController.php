<?php

class CreateUserController
{
    private ICreateUserRepository $createUserRepository;

    public function __construct(ICreateUserRepository $createUserRepository)
    {
        $this->createUserRepository = $createUserRepository;
    }

    public function handle(CreateUserDTO $createUserDTO): UserModel
    {
        return $this->createUserRepository->createUser($createUserDTO);
    }
}

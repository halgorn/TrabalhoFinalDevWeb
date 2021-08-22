<?php

class AuthenticateUserController
{
    private IAutheticateUserRepository $autheticateUserRepository;

    public function __construct(IAutheticateUserRepository $autheticateUserRepository)
    {
        $this->autheticateUserRepository = $autheticateUserRepository;
    }

    public function handle(AuthenticateUserDTO $authenticateUserDTO): int
    {
        return $this->autheticateUserRepository->authenticateUser($authenticateUserDTO);
    }
}

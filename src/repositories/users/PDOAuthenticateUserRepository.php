<?php

class PDOAuthenticateUserRepository implements IAutheticateUserRepository
{
    private IHashAdapter $hashAdapter;

    public function __construct(IHashAdapter $hashAdapter)
    {
        $this->hashAdapter = $hashAdapter;
    }

    public function authenticateUser(AuthenticateUserDTO $authenticateUserDTO): int
    {
        $sql = 'SELECT * FROM users WHERE email = :email';

        $stmt = Connection::$instance->prepare($sql);

        if (!$stmt->execute([':email' => $authenticateUserDTO->email])) {
            throw new InvalidCredentialsError();
        }

        $user = $stmt->fetch();

        if (!$user || !sizeof($user) || !isset($user['id'])) {
            throw new UserNotFoundError();
        }

        $isPasswordValid = $this->hashAdapter->compare(
            $authenticateUserDTO->password,
            $user['password']
        );

        if (!$isPasswordValid) {
            throw new InvalidCredentialsError();
        }

        return $user['id'];
    }
}

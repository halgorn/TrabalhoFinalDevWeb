<?php

class PDOCreateUserRepository implements ICreateUserRepository
{
    private IHashAdapter $hashAdapter;

    public function __construct(IHashAdapter $hashAdapter)
    {
        $this->hashAdapter = $hashAdapter;
    }

    public function createUser(CreateUserDTO $createUserDTO): UserModel
    {
        $sql = 'SELECT * FROM users WHERE email = :email';

        $stmt = Connection::$instance->prepare($sql);
        $stmt->execute([':email' => $createUserDTO->email]);

        if ($stmt->fetch()) {
            throw new UserAlreadyExistsError();
        }

        $passwordHashed = $this->hashAdapter->generate($createUserDTO->password);

        $sql = '
            INSERT INTO users(name, email, password, symptoms)
            VALUES(:name, :email, :password, :symptoms)
        ';

        $stmt = Connection::$instance->prepare($sql);
        $stmt->execute([
            ':name' => $createUserDTO->name,
            ':email' => $createUserDTO->email,
            ':password' => $passwordHashed,
            ':symptoms' => $createUserDTO->symptoms,
        ]);

        $createdUserId = Connection::$instance->lastInsertId();

        if (!isset($createdUserId)) {
            throw new UserCreateError();
        }

        $userDto = new stdClass();
        $userDto->id = $createdUserId;
        $userDto->email = $createUserDTO->email;
        $userDto->password = $createUserDTO->password;
        $userDto->name = $createUserDTO->name;
        $userDto->symptoms = $createUserDTO->symptoms;

        return UserModel::fromDTO($userDto);
    }
}

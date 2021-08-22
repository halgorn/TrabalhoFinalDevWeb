<?php

class PDOFetchUserRepository implements IFetchUserRepository
{
    public function fetchUser(string $id): UserModel
    {
        $sql = 'SELECT * FROM users WHERE id = :id';

        $stmt = Connection::$instance->prepare($sql);

        if (!$stmt->execute([':id' => $id])) {
            throw new InvalidUserError();
        }

        $user = $stmt->fetch();

        if (!$user || !sizeof($user)) {
            throw new UserNotFoundError();
        }

        $userDto = new stdClass();
        $userDto->id = $user['id'];
        $userDto->email = $user['email'];
        $userDto->password = $user['password'];
        $userDto->name = $user['name'];
        $userDto->symptoms = $user['symptoms'];

        return UserModel::fromDTO($userDto);
    }
}

<?php

class PDOFetchUsersRepository implements IFetchUsersRepository
{
    public function fetchUsers(): array
    {
        $sql = 'SELECT * FROM users';

        $stmt = Connection::$instance->query($sql);
        $users = $stmt->fetchAll();

        if (!$users || !sizeof($users)) {
            return [];
        }

        $usersDtos = array_map(function(array $user) {
            $userDto = new stdClass();

            $userDto->id = $user['id'];
            $userDto->email = $user['email'];
            $userDto->password = $user['password'];
            $userDto->name = $user['name'];
            $userDto->symptoms = $user['symptoms'];

            return $userDto;
        }, $users);

        return UserModel::fromDTOCollection($usersDtos);
    }
}

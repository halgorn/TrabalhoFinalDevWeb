<?php

class UserModel
{
    public int $id;
    public string $email;
    public string $password;
    public string $name;
    public string $symptoms;


    public function __construct(int $id, string $email, string $password, string $name, string $symptoms)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->symptoms = $symptoms;
    }

    public static function fromDTO(stdClass $dto): UserModel
    {
        return new UserModel(
            (int) $dto->id,
            (string) $dto->email,
            (string) $dto->password,
            (string) $dto->name,
            (string) $dto->symptoms
        );
    }

    public static function fromDTOCollection(array $dtos): array
    {
        return array_map(function(stdClass $dto) {
            return new UserModel(
                (int) $dto->id,
                (string) $dto->email,
                (string) $dto->password,
                (string) $dto->name,
                (string) $dto->symptoms
            );
        }, $dtos);
    }
}

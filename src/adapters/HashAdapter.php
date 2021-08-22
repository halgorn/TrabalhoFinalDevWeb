<?php

class HashAdapter implements IHashAdapter
{
    private const HASH_STRATEGY = PASSWORD_BCRYPT;

    public function generate(string $payload): string
    {
        $hashedPayload = password_hash($payload, self::HASH_STRATEGY);

        return $hashedPayload;
    }

    public function compare(string $payload, string $hashedPayload): bool
    {
        $isEqual = password_verify($payload, $hashedPayload);

        return $isEqual;
    }
}

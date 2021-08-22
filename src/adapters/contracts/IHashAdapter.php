<?php

interface IHashAdapter
{
    public function generate(string $payload): string;

    public function compare(string $payload, string $hashedPayload): bool;
}

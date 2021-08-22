<?php

class Migrations
{
    public static function createTables(PDO $connection, IHashAdapter $hashAdapter): void
    {
        try {
            $createUsersTableSql = "
                CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    symptoms VARCHAR(255)
                );
            ";

            $adminPass = $hashAdapter->generate('admin');

            $insertAdminUserSql = "
                INSERT INTO users (name, email, password, symptoms)
                SELECT * FROM (SELECT 'admin', 'admin@mail.com', '$adminPass', 'Nenhum') AS tmp
                WHERE NOT EXISTS (
                    SELECT email FROM users WHERE email = 'admin@mail.com'
                ) LIMIT 1;
            ";

            $connection->query($createUsersTableSql);
            $connection->query($insertAdminUserSql);
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }
    }
}

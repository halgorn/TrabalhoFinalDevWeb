<?php

class Connection
{
    public static PDO $instance;

    private function __construct() {}

    public static function getInstance()
    {
        try {
            if (!isset(self::$instance)) {
                self::$instance = new PDO('sqlite:' . Config::PATH_TO_SQLITE_FILE);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::SQLITE_OPEN_READWRITE, true);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }

            return self::$instance;
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }
    }
}

Migrations::createTables(Connection::getInstance(), HashAdapterFactory::make());

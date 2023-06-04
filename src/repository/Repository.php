<?php

require_once __DIR__.'/../../Database.php';

class Repository
{
    protected static Repository $instance;
    protected Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public static function getInstance(): Repository
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
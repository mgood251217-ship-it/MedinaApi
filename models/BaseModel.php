<?php

require_once __DIR__ . '/../helper/Database.php';

class BaseModel
{
    protected $database;

    public function __construct($database = null)
    {
        $this->database = $database ?? Database::connect();
    }
}

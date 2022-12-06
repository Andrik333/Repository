<?php

namespace zadanie_7;

use zadanie_7\Migration;
use zadanie_7\CreateData;

class DB
{
    private $dbPath = '\dataBase.db';
    public $pdo;

    public function __construct(string $dbPath = null)
    {
        if ($dbPath) {
            $this->dbPath = $dbPath;
        }

        $fullPath = dirname(__FILE__) . $this->dbPath;
        $checkDB = file_exists($fullPath);
        $pdo = new \PDO("sqlite:" . $fullPath);
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;

        if (!$checkDB) {
            (new Migration)->run($pdo);
            (new CreateData)->run($pdo);
        }
    }
}
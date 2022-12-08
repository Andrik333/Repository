<?php

namespace src;

use src\Migration;

class DB extends \PDO
{
    private $dbPath = '\db\dataBase.db';

    public function __construct(string $dbPath = null)
    {
        if ($dbPath) {
            $this->dbPath = $dbPath;
        }

        $fullPath = dirname(__FILE__, 2) . $this->dbPath;

        $checkDB = file_exists($fullPath);
        parent::__construct("sqlite:" . $fullPath);
        $this->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        if (!$checkDB) {
            (new Migration)->run($this);
        }
    }
}
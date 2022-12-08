<?php

namespace src;

use src\BuildQuery;
use src\DB;

abstract class BaseModel
{
    public function __construct($data = [])
    {
        $vars = get_class_vars(self::className());
        foreach ($vars as $key => $value) {
            if (isset($data[$key])) {
                $this->$key = $data[$key];
            }
        }
    }

    public function save()
    {
        $db = new DB;
        $vars = get_object_vars($this);
        $table = (self::className())::TableName();
        foreach ($vars as $key => &$value) {
            if ($value) {
                $value = $db->quote(htmlspecialchars($value));
            } else {
                unset($vars[$key]);
            }
        }
        $sql = "INSERT INTO $table (" . implode(', ', array_keys($vars)) . ") VALUES (" . implode(',', array_values($vars)) .")";

        $db->exec($sql);
    }

    public function remove()
    {
        $db = new DB;
        $table = (self::className())::TableName();
        
        if (isset($this->id) and $this->id) {
            $sql = "DELETE FROM $table WHERE id='{$this->id}'";

            $db->exec($sql);
        }
    }

    public static function find()
    {
        return new BuildQuery(get_called_class()::TableName(), get_called_class());
    }

    public function __get($var)
    {
        if (isset($this->$var)) {
            return $this->$var;
        }
    }

    public function __set($var, $value)
    {
        if (isset($this->$var)) {
            $this->$var = $value;
        }
    }

    public static function className()
    {
        return get_called_class();
    }
}
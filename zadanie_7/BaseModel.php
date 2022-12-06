<?php

namespace zadanie_7;

use zadanie_7\BuildQuery;

abstract class BaseModel
{

    public static function find()
    {
        return new BuildQuery(get_called_class()::TableName(), get_called_class());
    }

}
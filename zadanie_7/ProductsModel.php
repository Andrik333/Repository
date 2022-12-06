<?php

namespace zadanie_7;

use zadanie_7\BaseModel;

class ProductsModel extends BaseModel
{
    public static function TableName()
    {
        return 'products';
    }
}
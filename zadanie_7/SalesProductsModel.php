<?php

namespace zadanie_7;

use zadanie_7\BaseModel;

class SalesProductsModel extends BaseModel
{
    public static function TableName()
    {
        return 'sales_products';
    }
}
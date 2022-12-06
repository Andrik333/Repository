<?php

namespace zadanie_7;

use zadanie_7\BaseModel;

class OrdersPorductsModel extends BaseModel
{
    public static function TableName()
    {
        return 'orders_products';
    }
}
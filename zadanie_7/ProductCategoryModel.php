<?php

namespace zadanie_7;

use zadanie_7\BaseModel;

class ProductCategoryModel extends BaseModel
{
    public static function TableName()
    {
        return 'product_category';
    }
}
<?php

spl_autoload_register(function($class) {
    preg_match('#(.+)\\\\(.+?)$#', $class, $match);
    $nameSpace = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($match[1]));
	$classFile = $match[2] . '.php';
	$path = dirname(__FILE__) . DIRECTORY_SEPARATOR . $nameSpace . DIRECTORY_SEPARATOR . $classFile;

	if (file_exists($path)) {
        require_once $path;
        
        if (class_exists($class, false)) {
            return true;
        } else {
            throw new \Exception("Class \"$match[2]\" not found in file $classFile.");
        }
    } else {
        throw new \Exception("File \"$classFile\" not found.");
    }
});

use zadanie_7\OrdersModel;
use zadanie_7\ProductsModel;
use zadanie_7\Table;

$products = ProductsModel::find()
    ->select(['products.name AS p_name', 'price', 'count', 'product_category.name AS c_name'])
    ->join([['left', 'product_category', 'products.category = product_category.id']])
    ->orderBy(['p_name' => 'ASC'])->getAll();

echo 'список всех товаров в алфавитном порядке по названию</br>' . Table::create(
    [
        'p_name' => 'Продукт',
        'price' => 'Цена',
        'count' => 'Количество',
        'c_name' => 'Категория'
    ], $products
) . '</br></br>';

$countInGroup = ProductsModel::find()
    ->select(['product_category.name as name', 'count(products.id) as count'])
    ->join([['left', 'product_category', 'products.category = product_category.id']])
    ->groupBy(['product_category.id'])->orderBy(['count' => 'DESC'])->getAll();

echo 'количество товаров в каждой категории </br>' . 
Table::create(
    [
        'name' => 'Категория',
        'count' => 'Количество товаров'
    ], $countInGroup
) . '</br></br>';

$countInGroup = ProductsModel::find()
    ->select(['products.name as p_name', 'max(products.price) as price', 'product_category.name as c_name'])
    ->join([['left', 'product_category', 'products.category = product_category.id']])
    ->groupBy(['product_category.id'])->orderBy(['price' => 'DESC'])->getAll();

echo 'самый дорогой товар в каждой категории </br>' . 
Table::create(
    [
        'c_name' => 'Категория',
        'p_name' => 'Продукт',
        'price' => 'Цена'
    ], $countInGroup
) . '</br></br>';

$sum = OrdersModel::find()
    ->select('SUM(CASE WHEN dob < date_purchase THEN CASE WHEN date_purchase < doe THEN price * (1 -(sale_procent / 100)) END ELSE price END) AS sum')
    ->join([
        ['left', 'orders_products AS o_p', 'orders.products = o_p.orders'],
        ['left', 'products', 'o_p.product = products.id'],
        ['left', 'sales_products AS s_p', 'products.id = s_p.product'],
        ['left', 'sales ', 's_p.sale = orders.sale']
    ])
    ->where('orders.id=1 AND (sales.id = orders.sale OR sales.id IS NULL)')
    ->getAll();

echo 'итоговая сумму заказа с учетом скидки, если время покупки удовлетворяет условиям акции </br>' . 
Table::create(
    [
        'sum' => 'Сумма'
    ], $sum
) . '</br></br>';


$countInGroup = ProductsModel::find()->select(['SUM(products.price) as price'])->getAll();

echo 'сумма, которую получит магазин, если продаст сейчас все товары со склада по цене без учета акций </br>' . 
Table::create(
    [
        'price' => 'Сумма'
    ], $countInGroup
) . '</br></br>';
<?php

namespace zadanie_7;

class Migration
{
    public function run($db)
    {
        $methods = implode(', ', get_class_methods(__CLASS__));
        preg_match_all('/\bcreateTable\w+\b/', $methods, $matches);

        foreach ($matches[0] as $method) {
            $db->exec($this->$method());
        }
    }

    private function createTableProducts()
    {
        return "CREATE TABLE products (
            id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE NOT NULL,
            name TEXT NOT NULL,
            price REAL NOT NULL,
            count INTEGER NOT NULL,
            category INTEGER NOT NULL
        );";
    }

    private function createTableProductCategory()
    {
        return "CREATE TABLE product_category (
            id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE NOT NULL,
            name TEXT NOT NULL
        );";
    }

    private function createTableSales()
    {
        return "CREATE TABLE sales (
            id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE NOT NULL,
            name TEXT NOT NULL,
            description TEXT NOT NULL,
            dob TEXT NOT NULL,
            doe TEXT NOT NULL,
            sale_procent REAL NOT NULL,
            products INTEGER NOT NULL
        );";
    }

    private function createTableSalesProducts()
    {
        return "CREATE TABLE sales_products (
            id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE NOT NULL,
            sale INTEGER NOT NULL,
            product INTEGER NOT NULL
        );";
    }

    private function createTableOrders()
    {
        return "CREATE TABLE orders (
            id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE NOT NULL,
            order_number INTEGER NOT NULL,
            products INTEGER NOT NULL,
            count INTEGER NOT NULL,
            date_purchase TEXT NULL,
            sale INTEGER NOT NULL
        );";
    }

    private function createTableOrdersPorducts()
    {
        return "CREATE TABLE orders_products (
            id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE NOT NULL,
            orders INTEGER NOT NULL,
            product INTEGER NOT NULL
        );";
    }
}
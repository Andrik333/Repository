<?php

namespace src;

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

    private function createTableUsers()
    {
        return "CREATE TABLE users (
            id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE NOT NULL,
            last_name TEXT NOT NULL,
            name TEXT NOT NULL,
            phone TEXT UNIQUE NOT NULL,
            login TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL,
            age TEXT NOT NULL
        );";
    }

    private function createTableNews()
    {
        return "CREATE TABLE news (
            id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE NOT NULL,
            title TEXT NOT NULL,
            text TEXT NOT NULL,
            autor TEXT NOT NULL,
            date_create TEXT NOT NULL
        );";
    }

    private function createTableComments()
    {
        return "CREATE TABLE comments (
            id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE NOT NULL,
            comment TEXT NOT NULL,
            autor TEXT NOT NULL,
            date_create TEXT NOT NULL,
            new TEXT NOT NULL
        );";
    }
}
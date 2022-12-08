<?php

spl_autoload_register(function($class) {
    preg_match('#(.+)\\\\(.+?)$#', $class, $match);
    $nameSpace = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($match[1]));
	$classFile = $match[2] . '.php';
	$path = dirname(__DIR__) . DIRECTORY_SEPARATOR . $nameSpace . DIRECTORY_SEPARATOR . $classFile;

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
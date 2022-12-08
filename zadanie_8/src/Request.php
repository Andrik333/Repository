<?php

namespace src;

class Request
{
    public function get($id = null, $nullValue = null)
    {
        $get = $_GET;

        if ($id) {
            $get = isset($get[$id]) ? $get[$id] : $nullValue;
        }
    
        return $get;
    }

    public function post($id = null, $nullValue = null)
    {
        $post = $_POST;

        if ($id) {
            $post = isset($post[$id]) ? $post[$id] : $nullValue;
        }
    
        return $post;
    }
}
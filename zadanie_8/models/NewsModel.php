<?php

namespace models;

use src\BaseModel;
use models\CommentsModel;
use models\UsersModel;

class NewsModel extends BaseModel
{
    public $id;
    public $title;
    public $text;
    public $autor;
    public $date_create;
    public $comments;

    public static function TableName()
    {
        return 'news';
    }

    public function getComments()
    {
        return [
            'type' => 'getAll',
            'class' => CommentsModel::className(),
            'link' => ['new' => 'id'],
            'joinWith' => ['autor'],
            'order' => 'date_create DESC'
        ];
    }

    public function getAutor()
    {
        return [
            'type' => 'getOne',
            'class' => UsersModel::className(),
            'link' => ['id' => 'autor']
        ];
    }
}
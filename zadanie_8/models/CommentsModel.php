<?php

namespace models;

use src\BaseModel;
use models\UsersModel;

class CommentsModel extends BaseModel
{
    public $id;
    public $comment;
    public $autor;
    public $date_create;
    public $new;

    public static function TableName()
    {
        return 'comments';
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
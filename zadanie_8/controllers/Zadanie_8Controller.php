<?php

namespace controllers;

use src\BaseController;
use src\DB;
use src\Components;
use models\NewsModel;
use models\CommentsModel;
use models\UsersModel;


class Zadanie_8Controller extends BaseController
{
    public function actionIndex()
    {
        $news = NewsModel::find()->joinWith(['autor'])->orderBy(['date_create'=> 'DESC'])->getAll();
        return $this->render('index', ['news' => $news]);
    }

    public function actionCreateNews()
    {
        $data = $this->request->post();

        if ($data) {
            $data['autor'] = $this->user->id;
            $data['date_create'] = Components::dateDB();
            $news = new NewsModel($data);
            try {
                $news->save();
                $this->showMessage('Новость добавлена', 'complite');
            } catch (\Exception $error) {
                $this->showMessage('Произошла ошибка при добавлении новости', 'error');
            }
        }

        return $this->render('create-news');
    }

    public function actionNewsRemove(int $id)
    {
        $news = NewsModel::find()->where(['id' => $id])->getOne();

        if ($news) {
            if ($news->autor != $this->user->id) {
                $this->showMessage('Невозможно удалить чужую публикацию', 'error', 'zadanie_8/news');
            } else {
                try {
                    $news->remove();
                    $comments = CommentsModel::find()->where(['new' => $id])->getAll();
                    foreach ($comments as $comment) {
                        $comment->remove();
                    }
                    $this->showMessage('Новость удалена', 'complite', 'zadanie_8/index');
                    return $this->redirect('index');
                } catch (\Exception $error) {
                    $this->showMessage('Произошла ошибка при удалении новости', 'error', 'zadanie_8/news');
                }
            }
        }

        return $this->redirect("news?id=$id");
    }

    public function actionAddCommentNews(int $id)
    {
        $comment = $this->request->post('comment');

        if ($comment) {
            $data = [
                'comment' => $comment,
                'autor' => $this->user->id,
                'date_create' => Components::dateDB(),
                'new' => $id
            ];

        }
        $newComment = new CommentsModel($data);
        try {
            $newComment->save();
            $this->showMessage('Комментарий добавлен', 'complite', 'zadanie_8/news');
        } catch (\Exception $error) {
            $this->showMessage('Произошла ошибка при добавлении комментария', 'error', 'zadanie_8/news');
        }
        return $this->redirect("news?id=$id");
    }

    public function actionNews(int $id)
    {   
        $new = NewsModel::find()->joinWith(['autor', 'comments'])->where(['id' => $id])->getOne();

        return $this->render('news-view', [
            'new' => $new
        ]);
    }

    public function actionLogin()
    {

        $data = $this->request->post();

        if ($data) {
            $user = UsersModel::find()->where(['login' => $data['login']])->getOne();

            if ($user and $user->validPassword($data['password'])) {
                $user->login();
                $this->showMessage('Вход выполнен', 'complite', 'zadanie_8/index');
                return $this->redirect('index');
            } else {
                $this->showMessage('Не верный логин или пароль');
            }
        }

        return $this->render('login');
    }

    public function actionLogout()
    {
        $this->user->logout();
        $this->showMessage('Выполнен выход', 'complite', 'zadanie_8/index');
        return $this->redirect('index');
    }

    public function actionRegistration()
    {
        $data = $this->request->post();

        if ($data) {
            $user = new UsersModel($data);
            if(!UsersModel::find()->where(['login' => $user->login])->getOne()) {
                try {
                    $user->password = password_hash($user->password, PASSWORD_DEFAULT);
                    $user->save();
                    $this->showMessage('Регистрация прошла успешно', 'complite', 'zadanie_8/login');
                    return $this->redirect('login');
                } catch (\Exception $error) {
                    $this->showMessage('Произошла ошибка при регистрации', 'error');
                    return $this->render('registration');
                }
            } else {
                $this->showMessage('Пользователь с логином "'.$data['login'].'" уже существует', 'error');
                return $this->render('registration');
            }
        } else {
            return $this->render('registration');
        }
    }

    public function actionRemoveComment(int $idNews, int $idComment)
    {
        $comment = new CommentsModel(['id' => $idComment]);
        try {
            $comment->remove();
            $data = CommentsModel::find()->where(['new' => $idNews])->orderBy(['date_create' => 'DESC'])->getAll();
            $comments = Components::createComments($data);
            return json_encode(['status' => true, 'message' => 'Комментарий удален', 'data' => $comments]);
        } catch (\Exception $error) {
            return json_encode(['status' => false, 'message' => 'Ошибка при удалении']);
        }
    }

    public function actionIndexFilterNews(string $autor)
    {
        $user = UsersModel::find()->where(['login' => $autor])->getOne();
        $data = NewsModel::find()->where('autor <> ' . Components::getValue($user, 'id'))
            ->joinWith(['autor'])->orderBy(['date_create'=> 'DESC'])->getAll();
        $news = Components::createNews($data);
        return json_encode(['message' => "Новости \"$autor\" скрыты", 'data' => $news]);
    }
}
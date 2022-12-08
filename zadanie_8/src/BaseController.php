<?php

namespace src;

use src\Request;
use models\UsersModel;

class BaseController
{
    public $layout = 'default';
    public $title = 'Документ';
    public $request;
    public $showMessage = [];
    public $user;
    public $controllerID;
    public $actionID;
    public $controllerPath;

    public function __construct()
    {
        $this->request = new Request();
        $this->user = (new UsersModel())->getUser() ?? new UsersModel;
        $app = new Application;
        $this->controllerID = $app->controller;
        $this->actionID = $app->action;
        $this->controllerPath = $app->controllerPath;
    }

    public function showMessage(string $text, string $type = 'error', string $url = null)
    {
        if (!$url) {
            $url = stristr($_SERVER['REQUEST_URI'], '?', true);
            $url = $url ? trim($url, '/') : trim($_SERVER['REQUEST_URI'], '/');
        }

        $this->showMessage[] = [
            'url' => $url,
            'text' => $text,
            'type' => $type // complite or error
        ];
    }

    public function render($view, $arrData = []) {
        return $this->renderLayout($this->renderView($view, $arrData));
    }

    public function redirect($link)
    {
        if ($this->showMessage) {
            session_start();
            $_SESSION["delayedMessage"] = $this->showMessage;
            session_write_close();
        }

        return header('Location: ' . $link);
    }
    
    public function renderLayout($content = null) {
        $layoutPath = dirname(__DIR__) . "/layouts/{$this->layout}.php";

        session_start();
        if (isset($_SESSION["delayedMessage"])) {
            foreach ($_SESSION["delayedMessage"] as $message) {
                $this->showMessage[] = $message;
            }
            unset($_SESSION["delayedMessage"]);
        }
        session_write_close();

        if (file_exists($layoutPath)) {
            ob_start();
                $title = $this->title;
                include $layoutPath;
            return ob_get_clean() . '<script>var dataMessages='.json_encode($this->showMessage).'</script>';
        } else {
            $this->layout = 'login';
            http_response_code(500);
            return $this->render('notPage', ['error' => 'Не найден файл с шаблоном страницы']);
        }
    }
    
    private function renderView($view, $arrData) {
        $viewPath = dirname(__DIR__) . "/views/$view.php";
        
        if (file_exists($viewPath)) {
            ob_start();
                extract($arrData);
                include $viewPath;
            return ob_get_clean();
        } else {
            $this->layout = 'login';
            http_response_code(500);
            return $this->render('notPage', ['error' => 'Не найден файл с шаблоном представления']);
        }
    }

}
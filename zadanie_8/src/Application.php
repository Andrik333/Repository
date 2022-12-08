<?php

namespace src;

use src\Request;

class Application
{
    public $action = 'actionIndex';
    public $controller = 'MainController';
    public $controllerPath = 'controllers/';

    public function __construct()
    {
        $url = array_filter(explode('/', trim(stristr($_SERVER['REQUEST_URI'], '?', true) ?: $_SERVER['REQUEST_URI'], "/")));

        if ($url) {
            $this->action = 'action' . implode(array_map('ucfirst', explode('-', mb_strtolower(array_pop($url)))));
        }

        if ($url) {
            $this->controller = implode(array_map('ucfirst', explode('-', mb_strtolower(array_pop($url))))) . 'Controller';
            $this->controllerPath = $this->controllerPath . implode('/', $url) . ($url ? '/' : '');
        }
    }

    public function run()
    {
        $fullName = str_replace('/', '\\', $this->controllerPath . $this->controller);

        try {
            $controller = new $fullName;

            if (method_exists($controller, $this->action)) {
                $params = [];
                $request = new Request;
                $requiredParameters = (new \ReflectionMethod($fullName, $this->action))->getParameters();
                foreach ($requiredParameters as $parameter) {
                    $params[] = $request->get($parameter->name);
                }
                $result = $controller->{$this->action}(...$params);
                echo $result; exit();
            } else {
                $result = $controller->render('notPage', ['error' => 'Страница не найдена']);
                http_response_code(404);
                echo $result; exit();
            }
        } catch (\Exception $error) {
            echo $error->getMessage(); exit();
        }
    }
}
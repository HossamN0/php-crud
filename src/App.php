<?php
namespace Hossam\ActionsNextJs;

class App
{
    private $url;
    private $controller;
    private $method;
    private $params;
    public function __construct($query)
    {
        $this->url = $query;
        $this->bootUrl();
        $this->callMethod();
    }

    public function bootUrl()
    {
        $splited_query = explode('/', $this->url);
        if ((!isset($splited_query[0])) || (!isset($splited_query[1]))) {
            return;
        }
        $this->controller = $splited_query[0];
        $this->method = $splited_query[1];
        if (isset($splited_query[2])) {
            $this->params = $splited_query[2];
        }
    }

    public function callMethod()
    {
        if ((!isset($this->controller)) || (!isset($this->method))) {
            return;
        }
        $this->controller = "Hossam\ActionsNextJs\Controller\\" . $this->controller;
        if (class_exists($this->controller)) {
            $controller = new $this->controller;
            if (method_exists($this->controller, $this->method)) {
                if (isset($this->params)) {
                    call_user_func_array([$controller, $this->method], [$this->params]);
                } else {
                    call_user_func([$controller, $this->method]);
                }
            } else {
                echo 'Method Not Found';
            }
        } else {
            echo 'Class Not Found';
        }
    }
}
?>
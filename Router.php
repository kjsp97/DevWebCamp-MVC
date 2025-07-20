<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function checkRoutes()
    {
        session_start();
        $isAdmin = !empty($_SESSION['admin']);

        $url_actual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$url_actual] ?? null;
        } else {
            $fn = $this->postRoutes[$url_actual] ?? null;
        }

        if (str_contains($url_actual, '/admin') && !$isAdmin) {
            header('Location: /');
        }
        
        if ( $fn ) {
            call_user_func($fn, $this);
        } else {
            echo "😕 404 <hr /> Página no válida, regresa a <strong>devwebcamp.com</strong> para seleccionar una nueva dirección.";
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }

        ob_start(); 

        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();

        $url_actual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';

        if (str_contains($url_actual, '/admin')) {
            include_once __DIR__ . '/views/admin-layout.php';
        }else{
            include_once __DIR__ . '/views/layout.php';
        }
    }
}

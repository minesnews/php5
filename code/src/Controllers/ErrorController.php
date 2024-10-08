<?php

namespace Geekbrains\Application1\Controllers;
use Geekbrains\Application1\Render;

class ErrorController{
    public function metodNoFound($methodName){
        $render404 = new Render();
        header($_SERVER["SERVER_PROTOCOL"]." 404");
        return $render404->renderPage('error.twig', ['methodName' => $methodName]);
    }

    public function classNoFound($controllerName){
        $render404 = new Render();
        header($_SERVER["SERVER_PROTOCOL"]." 404");
        return $render404->renderPage('error404.twig', ['controllerName' => $controllerName]);
    }
}
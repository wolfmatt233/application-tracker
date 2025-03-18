<?php

namespace Api\Controllers;

use Api\Models\Application;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Controller
{
    public function index(Request $request, Response $response, array $args)
    {
        $applications = Application::getApplications();
        ob_start();
        include __DIR__ . '../../Pages/list.php';
        $html = ob_get_clean();
        echo $html;
      
        return $response;
    }
}
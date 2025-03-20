<?php

namespace Api\Controllers;

use Api\Models\Application;
use Api\Models\Status;
use Api\Pages\CreateForm;
use Api\Pages\EditForm;
use Api\Pages\View;
use Api\Pages\IndexList;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Controller
{
    public static function sendHeader($uri)
    {
        $host = $_SERVER['HTTP_HOST'];
        header("Location: http://$host/$uri");
        die();
    }

    public function index(Request $request, Response $response, array $args)
    {
        $params = $request->getQueryParams();
        $applications = '';

        if (count($params) > 0) {
            $applications = Application::getApplicationsByParams($params);
        } else {
            $applications = Application::getApplications();
        }

        $view = new IndexList();
        $view->display($applications, $params);

        return $response;
    }

    public function view(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $application = Application::getApplicationById($id);

        if (!$application) {
            self::sendHeader("applications");
        } else {
            $view = new View();
            $view->display($application);
        }
        
        return $response;
    }

    public function createForm(Request $request, Response $response, array $args)
    {
        $status = Status::getStatus();

        $view = new CreateForm();
        $view->display($status);

        return $response;
    }

    public function editForm(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $application = Application::getApplicationById($id);
        $status = Status::getStatus();

        $view = new EditForm();
        $view->display($id, $application, $status);

        return $response;
    }

    public function create(Request $request, Response $response, array $args)
    {
        $body = $request->getParsedBody();
        $application = Application::createApplication($body);

        self::sendHeader("applications/$application->id");
    }

    public function update(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $body = $request->getParsedBody();
        $application = Application::updateApplication($id, $body);

        self::sendHeader("applications/$application->id");
    }

    public function delete(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $application = Application::delete();

        self::sendHeader("/applications");
    }
}

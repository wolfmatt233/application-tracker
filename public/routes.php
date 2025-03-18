<?php

use Api\Controllers\Controller;
use Slim\Routing\RouteCollectorProxy as Group;
use Slim\Middleware\BodyParsingMiddleware as ParserMiddleware;

$app->group('/applications', function (Group $group) {
    $group->get('', [Controller::class, 'index']);
    $group->get('/{id}', [Controller::class, 'view']);
    $group->post('', [Controller::class, 'create']);
    $group->patch('/{id}', [Controller::class, 'update']);
    $group->delete('/{id}', [Controller::class, 'delete']);
});
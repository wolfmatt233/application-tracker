<?php

use Api\Controllers\Controller;
use Slim\Routing\RouteCollectorProxy as Group;

$app->get('/', function () {
    header("Location: http://localhost:5000/applications");
    die();
});

$app->group('/applications', function (Group $group) {
    $group->get('', [Controller::class, 'index']);
    $group->get('/create', [Controller::class, 'createForm']);
    $group->get('/{id}', [Controller::class, 'view']);
    $group->get('/{id}/edit', [Controller::class, 'editForm']);

    $group->post('', [Controller::class, 'create']);
    $group->patch('/{id}', [Controller::class, 'update']);
    $group->delete('/{id}', [Controller::class, 'delete']);
});
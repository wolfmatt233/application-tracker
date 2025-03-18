<?php

use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager;

// Slim routing
$app = AppFactory::create();
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Database

$capsule = new Manager();

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'job_tracker_db',
    'username' => 'root',
    'password' => ''
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// Define routes

require __DIR__ . '/routes.php';

$app->run();
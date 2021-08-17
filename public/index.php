<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
use App\Session;
$session = Session::getInstance();
?>

<?php

use App\Router;
use App\Controllers\ProductController;

$router = new Router();

$router->get('/', ProductController::class.'::show');
$router->get('/add-product', ProductController::class.'::add');
$router->post('/add-product', ProductController::class.'::addProduct');
$router->post('/', ProductController::class.'::getProducts');
$router->post('/delete', ProductController::class.'::deleteProducts');


$router->addNotFoundHandler(function() {
  echo "Not Found";
});

$router->run();


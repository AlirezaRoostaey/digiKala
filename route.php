<?php

use Controllers\MainController;
use Controllers\PageController;

require 'vendor/autoload.php';
require_once 'Services/DigiKalaService.php';
require_once 'Controllers/MainController.php';
require_once 'Controllers/PageController.php';


$digiKalaService = new DigiKalaService();

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'GET' && $requestUri === '/') {

    $mainController = new PageController();
    $mainController->show();
}
elseif ($requestMethod === 'POST' && $requestUri === '/search') {

    $data = json_decode(file_get_contents('php://input'), true);
    $mainController = new MainController($digiKalaService);
    $mainController->search($data);
}
elseif ($requestMethod === 'POST' && preg_match('/^\/product\/(\d+)$/', $requestUri, $matches)) {
    $productId = $matches[1];
    $data = json_decode(file_get_contents('php://input'), true);
    $mainController = new MainController($digiKalaService);
    $mainController->product($data, $productId);
}
else {
    $mainController = new PageController();
    $mainController->notFound();
}

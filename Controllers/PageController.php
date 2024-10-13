<?php
namespace Controllers;

require_once 'Controllers/Controller.php';
use http\Client\Request;
use DigiKalaService;

class PageController extends Controller
{

    public function notFound()
    {
        include ('Views/404.php');
    }

    public function show()
    {
        include ('Views/home.php');
    }

}
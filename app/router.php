<?php
namespace app;

use app\controller\ApiController;
use app\controller\ViewController;

$route = array_keys($_REQUEST);

if($route[0] == '/'){
    $controller = new ViewController();
    $controller->index();
}

if($route[0] == '/api/get'){
    $controller = new ApiController();
    $controller->getList();
}

if($route[0] == '/api/save'){
    $controller = new ApiController();
    $controller->save();
}

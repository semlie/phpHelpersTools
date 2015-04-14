<?php
require 'vendor/slim/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->response->headers->set('Content-Type', 'application/json');
$app->get('/hello/:name', function ($name) {
    $a = array();
    $a[] = Array("aa"=>"b","as"=>"sd");
            
    echo json_encode($a);
});
$app->get('/', function () {
    echo "Hello defoult, ";
});
$app->run();
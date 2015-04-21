<?php

require 'vendor/slim/slim/Slim/Slim.php';
//require_once 'wishList/managmentWishlist.php';
require_once 'helpers.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
//
//ruotes 
$app->get('/hello/:name', function ($name) {
    $a = array();
    $a[] = Array("aa" => "b", "as" => "sd");

    echo json_encode($a);
});
$app->get('/leads/:url', "getLeadsForm");
$app->post('/leads/:url', "newLeads");
$app->get('/video/:campain/:userId', "getVideoToUser");
//$app->get('/video/player/', "getVideoplayer");

$app->get('/', function () {
    echo "Hello defoult, ";
});
$app->run();

function getVideoToUser($campain,$userId) {
    global $app;
   
    //$w = new wishlist/managmentWishlist();
    //$campainId = $w;
    $text = helpers::readCsvFileFromWebAndReturnArray($campain.".csv");
    $app->response->headers->set('Content-Type', 'application/json');
//    echo json_encode($text,JSON_UNESCAPED_UNICODE);
    echo json_encode($text);
    //$app->response()->head
}

function getVideoplayer() {
    global $app;
    //$app->view()->setData(array('url' => $url));
    $app->render('index.php');
    // echo $url.':get new lead';
}
function getLeadsForm($url) {
    global $app;
    $app->view()->setData(array('url' => $url));
    $app->render('leads-forms.php');
    // echo $url.':get new lead';
}

function newLeads($url) {
    global $app;
//    $app->view()->setData(array('url' => $url));
//    $app->render('leads-forms.php');
    echo json_encode($app->request->getBody());
}

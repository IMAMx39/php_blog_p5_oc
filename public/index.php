<?php

use App\Controller\HomeController;
use Core\Application;
use Core\Request;

require '../vendor/autoload.php';

$app = new Application();

$app->getRouter()->get('/^\/$/', static function (Request $request) {
    return (new HomeController())->contact($request);
});

$response = $app->request(new Request());
http_response_code($response->getStatus());
echo $response->getContent();
exit();
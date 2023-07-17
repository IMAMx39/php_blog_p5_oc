<?php

use Core\Application;
use Core\Request;

require '../vendor/autoload.php';

$app = new Application();



$response = $app->request(new Request());
http_response_code($response->getStatus());
echo $response->getContent();
exit();
<?php

require __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use Silex\Application;
use SilexPsr7\Adapter\Controller;
use Zend\Diactoros\Response;

$app = new Application();
$adapter = new Controller($app);

$app->get(
    '/',
    $adapter->createController(
        function (ServerRequestInterface $request) {
            $response = new Response();
            $body = $response->getBody();

            $body->write("Hello World!");

            $params = $request->getServerParams();
            if (isset($params['HTTP_HOST'])) {
                $body->write("<br>");
                $body->write("<i>Server at " . $params['HTTP_HOST'] . "</i>");
            }

            return $response;
        }
    )
);

$app->run();

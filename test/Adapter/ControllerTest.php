<?php
namespace SilexPsr7Test\Adapter;

use PHPUnit_Framework_TestCase;
use Psr\Http\Message\RequestInterface;
use Silex\Application;
use SilexPsr7\Adapter\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zend\Diactoros\Response as Psr7Response;

class ControllerTest extends PHPUnit_Framework_TestCase
{
    public function testClosure()
    {
        $callback = function (RequestInterface $request) {
            return new Psr7Response();
        };

        $app = new Application();

        $adapter = new Controller($app);
        $wrappedCallback = $adapter->createController($callback);

        $request = Request::create('http://example.com/');

        $result = $wrappedCallback($request);

        $this->assertInstanceOf(Response::class, $result);
    }
}
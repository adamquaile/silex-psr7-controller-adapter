<?php
namespace SilexPsr7Test\Adapter;

use PHPUnit_Framework_TestCase;
use Psr\Http\Message\RequestInterface;
use Silex\Application;
use SilexPsr7\Adapter\Controller;
use SilexPsr7Test\Lib\DummyController;
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

    public function testClass()
    {
        $app = new Application();

        $adapter = new Controller($app);
        $wrappedCallback = $adapter->createController(new DummyController());

        $request = Request::create('http://example.com/');

        $result = $wrappedCallback($request);

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testString()
    {
        $app = new Application();

        $adapter = new Controller($app);
        $wrappedCallback = $adapter->createController("SilexPsr7Test\\Lib\\DummyController::testAction");

        $request = Request::create('http://example.com/');

        $result = $wrappedCallback($request);

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testArray()
    {
        $app = new Application();

        $controller = new DummyController();
        $adapter = new Controller($app);
        $wrappedCallback = $adapter->createController([$controller, 'testAction']);

        $request = Request::create('http://example.com/');

        $result = $wrappedCallback($request);

        $this->assertInstanceOf(Response::class, $result);
    }
}

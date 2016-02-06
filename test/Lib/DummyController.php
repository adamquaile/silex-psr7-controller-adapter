<?php
namespace SilexPsr7Test\Lib;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

class DummyController
{
    public function testAction(ServerRequestInterface $request)
    {
        return new Response();
    }

    public function __invoke(ServerRequestInterface $request)
    {
        return new Response();
    }
}

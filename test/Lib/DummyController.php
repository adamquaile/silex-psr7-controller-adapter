<?php
namespace SilexPsr7Test\Lib;

use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\Response;

class DummyController
{
    public function testAction(RequestInterface $request)
    {
        return new Response();
    }

    public function  __invoke(RequestInterface $request)
    {
        return new Response();
    }
}

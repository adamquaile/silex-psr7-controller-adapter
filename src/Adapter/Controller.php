<?php
namespace SilexPsr7\Adapter;

use Silex\Application;
use SilexPsr7\ControllerResolver;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Component\HttpFoundation\Request;

/**
 * This adapter wraps a PSR-7 compatible controller and makes
 */
class Controller
{
    /** @var HttpFoundationFactory */
    private $httpFoundationFactory;

    /** @var ControllerResolver */
    private $controllerResolver;

    /**
     * @param Application $app Silex application
     */
    public function __construct(Application $app)
    {
        $this->httpFoundationFactory = new HttpFoundationFactory();
        $this->controllerResolver = new ControllerResolver($app);
    }

    /**
     * @param callable|string $controller
     * @return \Closure
     */
    public function createController($controller)
    {
        return function (Request $request) use ($controller) {
            $arguments = $this->controllerResolver->getArguments($request, $controller);
            $psr7Response = call_user_func_array($controller, $arguments);

            return $this->httpFoundationFactory->createResponse($psr7Response);
        };
    }
}
<?php
namespace SilexPsr7;

use Psr\Http\Message\RequestInterface;
use Silex\ControllerResolver as SilexControllerResolver;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
use Symfony\Component\HttpFoundation\Request;

/**
 * This class extends the default SilecControllerResolver to inject the PSR-7 request object if needed
 */
class ControllerResolver extends SilexControllerResolver
{
    /** {@inheritdoc} */
    protected function doGetArguments(Request $request, $controller, array $parameters)
    {
        $psr7Factory = new DiactorosFactory();
        foreach ($parameters as $param) {
            if ($param->getClass() && $param->getClass()->getName() === RequestInterface::class) {
                $request->attributes->set($param->getName(), $psr7Factory->createRequest($request));

                break;
            }
        }

        return parent::doGetArguments($request, $controller, $parameters);
    }
}

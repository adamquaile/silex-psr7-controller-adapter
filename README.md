# PSR-7 controller adapter for Silex

[![Build Status](https://travis-ci.org/voidcontext/silex-psr7-controller-adapter.svg?branch=master)](https://travis-ci.org/voidcontext/silex-psr7-controller-adapter)

This adapter helps to reuse "controllers" from other PSR-7 compatible frameworks (like SlimPHP).

### Installation

```bash
$ composer require voidcontext/silex-psr7-controller-adapter
```

### Usage

```php
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
            $response->getBody()->write("Hello World!");

            return $response;
        }
    )
);

$app->run();
```

### License

The MIT License (MIT)

Copyright (c) 2016 Gabor Pihaj

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

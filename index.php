<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

require_once 'vendor/autoload.php';

$fileLocator = new FileLocator([__DIR__ . '/config']);
$loader = new PhpFileLoader($fileLocator);

$routes = $loader->load('routes.php');

$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

try {
    $attributes = $matcher->match($request->getPathInfo());

    $controller = $attributes['_controller'];
    unset($attributes['_controller']);

    $response = call_user_func_array($controller, $attributes);
} catch (RuntimeException $e) {
    $response = new Response('Page not found', Response::HTTP_NOT_FOUND);
}

$response->send();
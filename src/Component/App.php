<?php

namespace TestShop\Component;

use RuntimeException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class App
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class App
{
    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($this->getRoutes(), $context);

        try {
            $attributes = $matcher->match($request->getPathInfo());

            $controller = $attributes['_controller'];
            unset($attributes['_controller']);

            $response = call_user_func_array($controller, $attributes);
        } catch (RuntimeException $e) {
            $response = new Response(['error' => 'Page not found'], Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    /**
     * @return RouteCollection
     */
    protected function getRoutes(): RouteCollection
    {
        $fileLocator = new FileLocator([__DIR__ . '/../../config']);
        $loader = new PhpFileLoader($fileLocator);

        return $loader->load('routes.php');
    }
}

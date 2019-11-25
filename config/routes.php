<?php
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use TestShop\Controller\ProductsController;

return static function (RoutingConfigurator $routes) {
    $routes->add('get_products', 'product')
        ->controller([ProductsController::class, 'index'])
        ->methods(['GET']);

    $routes->add('create_products', 'product')
        ->controller([ProductsController::class, 'create'])
        ->methods(['POST']);
};

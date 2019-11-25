<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use TestShop\Controller\OrderPaymentsController;
use TestShop\Controller\OrdersController;
use TestShop\Controller\ProductsController;

return static function (RoutingConfigurator $routes) {
    $routes->add('get_products', 'product')
        ->controller([ProductsController::class, 'index'])
        ->methods(['GET']);

    $routes->add('create_products', 'product')
        ->controller([ProductsController::class, 'create'])
        ->methods(['POST']);

    $routes->add('create_order', 'order')
        ->controller([OrdersController::class, 'create'])
        ->methods(['POST']);

    $routes->add('pay_order', 'order/{orderId}/payment')
        ->controller([OrderPaymentsController::class, 'create'])
        ->methods(['POST'])
        ->requirements(['orderId' => '\d+']);
};

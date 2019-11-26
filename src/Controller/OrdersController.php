<?php

namespace TestShop\Controller;

use Symfony\Component\HttpFoundation\Request;
use TestShop\Component\Response;
use TestShop\Repository\OrderRepository;
use TestShop\Repository\ProductRepository;
use TestShop\Service\OrderService;

/**
 * Class OrdersController
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class OrdersController
{
    /**
     * @return Response
     */
    public function create(): Response
    {
        $productIds = explode(',', Request::createFromGlobals()->request->get('productIds', ''));

        if (empty($productIds)) {
            return new Response(['error' => 'Product ids not set'], Response::HTTP_BAD_REQUEST);
        }

        $productRepository = new ProductRepository();
        $products = $productRepository->getAllByIds($productIds);

        if (empty($products)) {
            return new Response(['error' => 'Products not found'], Response::HTTP_BAD_REQUEST);
        }

        if (count($products) !== count($productIds)) {
            return new Response(['error' => 'Products not found'], Response::HTTP_BAD_REQUEST);
        }

        $orderService = new OrderService();
        $orderRepository = new OrderRepository();

        $order = $orderService->buildNewOrder(...$products);

        if (!$orderRepository->create($order)) {
            return new Response(['error' => 'Order was not created'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response(['orderId' => $order->getId()], Response::HTTP_OK);
    }
}

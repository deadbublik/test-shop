<?php

namespace TestShop\Controller;

use TestShop\Component\Response;
use TestShop\Entity\Order;
use TestShop\Repository\OrderRepository;

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
        $orderRepository = new OrderRepository();

        $order = new Order();
        $order->setStatus(Order::STATUS_NEW);
        $order->setTotal(random_int(1000, 10000));

        if (!$orderRepository->create($order)) {
            return new Response(['error' => 'Order was not created'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response(['orderId' => $order->getId()], Response::HTTP_OK);
    }
}

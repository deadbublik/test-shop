<?php

namespace TestShop\Controller;

use Symfony\Component\HttpFoundation\Request;
use TestShop\Component\Response;
use TestShop\Repository\OrderRepository;
use TestShop\Service\OrderPaymentService;

/**
 * Class OrderPaymentsController
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class OrderPaymentsController
{
    /**
     * @param int $orderId
     * @return Response
     */
    public function create(int $orderId): Response
    {
        $price = (float)Request::createFromGlobals()->request->get('price', 0);

        if (empty($price)) {
            return new Response(['error' => 'Price not set'], Response::HTTP_BAD_REQUEST);
        }

        $orderRepository = new OrderRepository();
        $order = $orderRepository->getById($orderId);

        if ($order === null) {
            return new Response(['error' => 'Order not found'], Response::HTTP_BAD_REQUEST);
        }

        if ($order->isPaid()) {
            return new Response(['error' => 'Order has already been paid'], Response::HTTP_BAD_REQUEST);
        }

        if ($order->getTotal() !== $price) {
            return new Response(['error' => 'Payment is different from order total'], Response::HTTP_BAD_REQUEST);
        }

        $orderPaymentService = new OrderPaymentService();

        if (!$orderPaymentService->pay($order)) {
            return new Response(['error' => 'Order was not paid'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $orderRepository->setStatusPaid($order);

        return new Response(['price' => $price], Response::HTTP_OK);
    }
}

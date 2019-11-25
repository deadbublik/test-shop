<?php

namespace TestShop\Repository;

use TestShop\Component\DataBaseAbstractionLayer;
use TestShop\Entity\Order;

/**
 * Class OrderRepository
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class OrderRepository extends BaseRepository
{
    /**
     * @param array $data
     * @return Order
     */
    protected function createEntity(array $data): Order
    {
        $order = new Order();
        $order->setId((int)$data['id']);
        $order->setStatus((int)$data['status']);
        $order->setTotal((float)$data['total']);

        return $order;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function create(Order $order): bool
    {
        $data = [
            'status' => $order->getStatus(),
            'total' => $order->getTotal(),
        ];

        $connection = DataBaseAbstractionLayer::getConnection();
        $numberRows = $connection->insert('orders', $data);

        if ($numberRows <= 0) {
            return false;
        }

        $order->setId($connection->lastInsertId());

        return true;
    }
}

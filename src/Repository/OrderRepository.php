<?php

namespace TestShop\Repository;

use Doctrine\DBAL\ParameterType;
use Exception;
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
     * @param int $id
     * @return Order|null
     */
    public function getById(int $id): ?Order
    {
        $sql = 'SELECT * FROM orders WHERE id = :id';

        $connection = DataBaseAbstractionLayer::getConnection();
        $statement = $connection->prepare($sql);
        $statement->bindValue('id', $id, ParameterType::INTEGER);
        $statement->execute();

        $result = $statement->fetch();

        if ($result !== false) {
            return $this->createEntity($result);
        }

        return null;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function create(Order $order): bool
    {
        $connection = DataBaseAbstractionLayer::getConnection();
        $connection->beginTransaction();

        try {
            $numberRows = $connection->insert('orders', [
                'status' => $order->getStatus(),
                'total' => $order->getTotal(),
            ]);

            if ($numberRows <= 0) {
                $connection->rollBack();
                return false;
            }

            $order->setId($connection->lastInsertId());

            foreach ($order->getProducts() as $product) {
                $numberRows = $connection->insert('order_products', [
                    'order_id' => $order->getId(),
                    'product_id' => $product->getId(),
                ]);

                if ($numberRows <= 0) {
                    $connection->rollBack();
                    return false;
                }
            }
        } catch (Exception $e) {
            $connection->rollBack();
            return false;
        }

        $connection->commit();

        return true;
    }

    /**
     * @param Order $order
     * @param int $status
     * @return bool
     */
    public function setStatus(Order $order, int $status): bool
    {
        $connection = DataBaseAbstractionLayer::getConnection();
        $numberRows = $connection->update('orders', ['status' => $status], ['id' => $order->getId()]);

        return $numberRows > 0;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function setStatusPaid(Order $order): bool
    {
        return $this->setStatus($order, Order::STATUS_PAID);
    }
}

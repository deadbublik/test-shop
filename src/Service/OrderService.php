<?php

namespace TestShop\Service;

use TestShop\Entity\Order;
use TestShop\Entity\Product;

/**
 * Class OrderService
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class OrderService
{
    /**
     * @param Product[] $products
     * @return Order
     */
    public function buildNewOrder(Product ...$products): Order
    {
        $order = new Order();
        $order->setStatus(Order::STATUS_NEW);
        $order->setTotal($this->calculateTotal(...$products));
        $order->addProduct(...$products);

        return $order;
    }

    /**
     * @param Product ...$products
     * @return float
     */
    protected function calculateTotal(Product ...$products): float
    {
        $total = 0;

        foreach ($products as $product) {
            $total += $product->getPrice();
        }

        return (float)$total;
    }
}

<?php

namespace TestShop\Repository;

use TestShop\Entity\Product;

/**
 * Class ProductRepository
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class ProductRepository
{
    /**
     * @return Product[]
     */
    public function getAll(): array
    {
        return [
            new Product(),
            new Product()
        ];
    }

    /**
     * @return bool
     */
    public function create(): bool
    {
        return true;
    }
}

<?php

namespace TestShop\Service;

use TestShop\Entity\Product;

/**
 * Class ProductService
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class ProductService
{
    /**
     * @return Product
     */
    public function buildTestProduct(): Product
    {
        $product = new Product();
        $product->setName('Товар ' . md5(random_int(1, 100000)));
        $product->setPrice((float)random_int(1000, 100000));

        return $product;
    }
}

<?php

namespace TestShop\Repository;

use TestShop\Component\DataBaseAbstractionLayer;
use TestShop\Entity\Product;

/**
 * Class ProductRepository
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class ProductRepository extends BaseRepository
{
    /**
     * @param array $data
     * @return Product
     */
    protected function createEntity(array $data): Product
    {
        $product = new Product();
        $product->setId((int)$data['id']);
        $product->setName($data['name']);
        $product->setPrice((float)$data['price']);

        return $product;
    }

    /**
     * @return Product[]
     */
    public function getAll(): array
    {
        $sql = 'SELECT * FROM products';

        $connection = DataBaseAbstractionLayer::getConnection();
        $statement = $connection->query($sql);

        return $this->createEntityCollection($statement->fetchAll());
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function create(Product $product): bool
    {
        $data = [
            'name' => $product->getName(),
            'price' => $product->getPrice(),
        ];

        $connection = DataBaseAbstractionLayer::getConnection();
        $numberRows = $connection->insert('products', $data);

        if ($numberRows <= 0) {
            return false;
        }

        $product->setId($connection->lastInsertId());

        return true;
    }
}

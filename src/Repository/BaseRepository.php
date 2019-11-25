<?php

namespace TestShop\Repository;

/**
 * Class BaseRepository
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
abstract class BaseRepository
{
    /**
     * @param array $data
     * @return mixed
     */
    abstract protected function createEntity(array $data);

    /**
     * @param array $data
     * @return array
     */
    protected function createEntityCollection(array $data): array
    {
        $products = [];

        foreach ($data as $value) {
            $products[] = $this->createEntity($value);
        }

        return $products;
    }
}

<?php

namespace TestShop\Entity;

/**
 * Class Order
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class Order
{
    public const STATUS_NEW = 0;
    public const STATUS_PAID = 1;

    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $status;
    /**
     * @var float
     */
    private $total;
    /**
     * @var Product[]
     */
    private $products;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->products = [];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->status === self::STATUS_PAID;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    /**
     * @param Product[] $products
     */
    public function addProduct(Product ...$products): void
    {
        foreach ($products as $product) {
            if (!isset($this->products[$product->getId()])) {
                $this->products[$product->getId()] = $product;
            }
        }
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}

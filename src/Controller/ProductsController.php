<?php

namespace TestShop\Controller;

use TestShop\Component\Response;
use TestShop\Entity\Product;
use TestShop\Repository\ProductRepository;

/**
 * Class ProductsController
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class ProductsController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAll();

        return new Response(['products' => $products], Response::HTTP_OK);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        $productRepository = new ProductRepository();
        $productIds = [];

        for ($i = 1; $i <= 20; $i++) {
            $product = new Product();
            $product->setName('Товар ' . md5(random_int(1, 100000)));
            $product->setPrice((float)random_int(1000, 100000));

            if ($productRepository->create($product)) {
                $productIds[] = $product->getId();
            }
        }

        if (empty($productIds)) {
            return new Response(['error' => 'Products were not created'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response(['productIds' => $productIds], Response::HTTP_OK);
    }
}

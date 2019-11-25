<?php

namespace TestShop\Controller;

use TestShop\Component\Response;
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

        if (!$productRepository->create()) {
            return new Response(['error' => 'Product was not created'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response(['success' => 'create'], Response::HTTP_OK);
    }
}

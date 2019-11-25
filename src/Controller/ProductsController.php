<?php

namespace TestShop\Controller;

use TestShop\Component\Response;

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
        $products = [];

        return new Response(['products' => $products], Response::HTTP_OK);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return new Response(['success' => 'create'], Response::HTTP_OK);
    }
}

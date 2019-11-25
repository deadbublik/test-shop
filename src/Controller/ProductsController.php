<?php

namespace TestShop\Controller;

use Symfony\Component\HttpFoundation\Response;

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
        return new Response('index', Response::HTTP_OK);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return new Response('create', Response::HTTP_OK);
    }
}

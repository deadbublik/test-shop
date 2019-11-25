<?php

namespace TestShop\Component;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class Response
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class Response extends SymfonyResponse
{
    /**
     * Response constructor.
     *
     * @param array $content
     * @param int $status
     * @param array $headers
     */
    public function __construct(array $content = [], int $status = 200, array $headers = [])
    {
        $content = json_encode($content, JSON_PRETTY_PRINT);
        $headers['content-type'] = 'application/json';

        parent::__construct($content, $status, $headers);
    }
}

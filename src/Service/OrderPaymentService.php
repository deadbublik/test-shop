<?php

namespace TestShop\Service;

use TestShop\Component\Response;
use TestShop\Entity\Order;

/**
 * Class OrderPaymentService
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class OrderPaymentService
{
    /**
     * @var string
     */
    protected $url = 'https://ya.ru/';

    /**
     * @param Order $order
     * @return bool
     */
    public function pay(Order $order): bool
    {
        $params = [
            'price' => $order->getTotal(),
        ];

        return $this->sendRequest($params);
    }

    /**
     * @param array $params
     * @return bool
     */
    protected function sendRequest(array $params): bool
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);

        $info = curl_getinfo($ch);

        curl_close($ch);

        return (int)$info['http_code'] === Response::HTTP_OK;
    }
}

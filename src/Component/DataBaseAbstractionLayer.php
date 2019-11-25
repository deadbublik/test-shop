<?php

namespace TestShop\Component;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

/**
 * Class PDOConnection
 *
 * @author Aleksei Kuznetsov <deadbublik@gmail.com>
 */
class DataBaseAbstractionLayer
{
    /**
     * @return Connection
     */
    public static function getConnection(): Connection
    {
        $connectionParams = require __DIR__ . '/../../config/db.php';

        return DriverManager::getConnection($connectionParams);
    }
}

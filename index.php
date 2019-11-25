<?php

use Symfony\Component\HttpFoundation\Request;
use TestShop\Component\App;

require_once 'vendor/autoload.php';

$app = new App();

$response = $app->handle(Request::createFromGlobals());
$response->send();

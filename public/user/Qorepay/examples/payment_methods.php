<?php

require_once '../vendor/autoload.php';

$config = include('config.php');

$qorepay = new \Qorepay\QorepayApi($config['brand_id'], $config['api_key'], $config['endpoint']);

$methods = $qorepay->getPaymentMethods('EUR');

print json_encode($methods);
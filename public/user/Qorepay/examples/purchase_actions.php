<?php

require_once '../vendor/autoload.php';

$config = include('config.php');

$qorepay = new \Qorepay\QorepayApi($config['brand_id'], $config['api_key'], $config['endpoint']);

$purchase_id = '999cce79-0e81-491a-b418-1779c88e6662';

$purchase = $qorepay->getPurchase($purchase_id);

//$refund = $qorepay->refundPurchase($purchase_id);

//$cancel = $qorepay->cancelPurchase($purchase_id);

//$release = $qorepay->releasePurchase($purchase_id);

//$capture = $qorepay->capturePurchase($purchase_id);

//$charge = $qorepay->chargePurchase($purchase_id, 'test');

//$deleteToken = $qorepay->deleteRecurringToken($purchase_id);

print json_encode($purchase);
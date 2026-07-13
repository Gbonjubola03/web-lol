<?php

require_once '../vendor/autoload.php';

$config = include('config.php');

$qorepay = new \Qorepay\QorepayApi($config['brand_id'], $config['api_key'], $config['endpoint']);

$client = new \Qorepay\Model\ClientDetails();
$client->email = 'test@example.com';
$purchase = new \Qorepay\Model\Purchase();
$purchase->client = $client;
$details = new \Qorepay\Model\PurchaseDetails();
$product = new \Qorepay\Model\Product();
$product->name = 'Test';
$product->price = 100;
$details->products = [$product];
$purchase->purchase = $details;
$purchase->brand_id = $config['brand_id'];
$purchase->success_redirect = 'https://gate.qorepay.com/api/v1/?success=1';
$purchase->failure_redirect = 'https://gate.qorepay.com/api/v1/?success=0';

$result = $qorepay->createPurchase($purchase);

if ($result && $result->checkout_url) {
	// Redirect user to checkout
	header("Location: " . $result->checkout_url);
	exit;
}
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ProviderLibrary\Models\AccountHolder;
use ProviderLibrary\Models\Card;
use ProviderLibrary\Models\ShippingAddress;
use ProviderLibrary\Models\Status;
use ProviderLibrary\PaymentService;

$config = require __DIR__ . '/../config/config.php';

$apiUrl = $config['apiUrl'];
$paymentService = new PaymentService($apiUrl);

// Transaction data
$accountHolder = new AccountHolder('John Doe', 'john.doe@example.com', '+123456789');
$card = new Card('4444333322221111', '12', '2026', 'visa', '123');
$shippingAddress = new ShippingAddress('123 Main St', 'New York', '10001', 'USA');
$status = new Status('pending', 'Transaction pending', 'low');

// Transaction creation
$transaction = $paymentService->createTransaction([
    'transactionId' => '7ac7f07f-fec5-48a3-afa0-f8ca41312a39',
    'amount' => 100.00,
    'currency' => 'USD',
    'status' => $status,
    'accountHolder' => $accountHolder,
    'card' => $card,
    'shippingAddress' => $shippingAddress
]);

// Transaction processing
$response = $paymentService->processPayment($transaction);

// Result output
echo "Transaction ID: " . $response->getTransactionId() . "\n";
echo "Card Token: " . $response->getCardToken() . "\n";
echo "Status: " . $response->getStatus()['description'] . "\n";

<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use ProviderLibrary\PaymentService;
use ProviderLibrary\Models\AccountHolder;
use ProviderLibrary\Models\Card;
use ProviderLibrary\Models\ShippingAddress;
use ProviderLibrary\Models\Transaction;
use ProviderLibrary\Models\Status;
use ProviderLibrary\Client;
use ProviderLibrary\Response\PaymentResponse;
use \PHPUnit\Framework\MockObject\Exception;

/**
 * Class PaymentServiceTest
 * @package tests
 * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
 */
class PaymentServiceTest extends TestCase
{
    private $paymentService;
    private $mockClient;

    protected function setUp(): void
    {
        $this->mockClient = $this->createMock(Client::class);

        $config = require __DIR__ . '/../config/config.php';
        $this->paymentService = new PaymentService($config['apiUrl']);
    }

    /**
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function testCreateTransaction()
    {
        $accountHolder = new AccountHolder('John Doe', 'john.doe@example.com', '+123456789');
        $card = new Card('4444333322221111', '12', '2026', 'visa', '123');
        $shippingAddress = new ShippingAddress('123 Main St', 'New York', '10001', 'USA');
        $status = new Status('pending', 'Transaction pending', 'low');

        // Creating a transaction
        $transactionData = [
            'transactionId' => '7ac7f07f-fec5-48a3-afa0-f8ca41312a39',
            'amount' => 100.00,
            'currency' => 'USD',
            'status' => $status,
            'accountHolder' => $accountHolder,
            'card' => $card,
            'shippingAddress' => $shippingAddress
        ];

        $transaction = $this->paymentService->createTransaction($transactionData);

        // Checking if the transaction is created correctly
        $this->assertEquals('7ac7f07f-fec5-48a3-afa0-f8ca41312a39', $transaction->getTransactionId());
        $this->assertEquals(100.00, $transaction->getAmount());
        $this->assertEquals('USD', $transaction->getCurrency());
        $this->assertEquals($accountHolder, $transaction->getAccountHolder());
        $this->assertEquals($card, $transaction->getCard());
        $this->assertEquals($shippingAddress, $transaction->getShippingAddress());
    }

    /**
     * @throws Exception
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function testProcessPaymentSuccess()
    {
        $accountHolder = new AccountHolder('John Doe', 'john.doe@example.com', '+123456789');
        $card = new Card('4444333322221111', '12', '2026', 'visa', '123');
        $shippingAddress = new ShippingAddress('123 Main St', 'New York', '10001', 'USA');
        $status = new Status('pending', 'Transaction pending', 'low');
        $transaction = new Transaction(
            '7ac7f07f-fec5-48a3-afa0-f8ca41312a39',
            100.00,
            'USD',
            $status,
            $accountHolder,
            $card,
            $shippingAddress
        );

        // Mocking an API response
        $mockResponse = $this->createMock(PaymentResponse::class);
        $mockResponse->method('getTransactionState')->willReturn('success');
        $mockResponse->method('getTransactionId')->willReturn('f96a2be7-88a5-4a2b-8d3e-34e0666e6c8c');
        $mockResponse->method('getCardToken')->willReturn('4920619521161111');
        $mockResponse->method('getStatus')->willReturn([
            'code' => '201.0000',
            'description' => 'The resource was successfully created.',
            'severity' => 'information'
        ]);

        // Setting the response that the client will return
        $this->mockClient->method('sendRequest')->willReturn($mockResponse);

        $response = $this->paymentService->processPayment($transaction);

        // Checking if the response is successful
        $this->assertEquals('f96a2be7-88a5-4a2b-8d3e-34e0666e6c8c', $response->getTransactionId());
        $this->assertEquals('4920619521161111', $response->getCardToken());
        $this->assertEquals('201.0000', $response->getStatus()['code']);
        $this->assertEquals('The resource was successfully created.', $response->getStatus()['description']);
    }

    /**
     * @throws Exception
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function testProcessPaymentFailure()
    {
        $accountHolder = new AccountHolder('Jane Doe', 'jane.doe@example.com', '+987654321');
        $card = new Card('5555666677778888', '01', '2025', 'mastercard', '456');
        $shippingAddress = new ShippingAddress('456 Main St', 'San Francisco', '94105', 'USA');
        $status = new Status('pending', 'Transaction pending', 'low');
        $transaction = new Transaction(
            '9b3f07c7-e4e1-4a9b-baf0-9c1e8ef30a9e',
            50.00,
            'EUR',
            $status,
            $accountHolder,
            $card,
            $shippingAddress
        );


        // Mocking an API response with an error
        $mockResponse = $this->createMock(PaymentResponse::class);
        $mockResponse->method('getTransactionState')->willReturn('failed');
        $mockResponse->method('getStatus')->willReturn([
            'code' => '400.0001',
            'description' => 'Invalid card number.',
            'severity' => 'error'
        ]);

        // Setting the response that the client will return
        $this->mockClient->method('sendRequest')->willReturn($mockResponse);

        // Processing the payment
        $response = $this->paymentService->processPayment($transaction);

        // Checking if the response contains an error
        $this->assertEquals('failed', $response->getTransactionState());
        $this->assertEquals('400.0001', $response->getStatus()['code']);
        $this->assertEquals('Invalid card number.', $response->getStatus()['description']);
    }
}

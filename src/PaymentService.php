<?php

namespace ProviderLibrary;

use ProviderLibrary\Models\Transaction;
use ProviderLibrary\Request\PaymentRequest;
use ProviderLibrary\Response\PaymentResponse;

/**
 * Class PaymentService
 * @package ProviderLibrary
 * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
 */
class PaymentService
{
    private Client $client;

    public function __construct(string $apiUrl)
    {
        $this->client = new Client($apiUrl);
    }

    /**
     * @param array $transactionData
     * @return Transaction
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function createTransaction(array $transactionData): Transaction
    {
        $this->validateData($transactionData);

        return new Transaction(
            $transactionData['transactionId'],
            $transactionData['amount'],
            $transactionData['currency'],
            $transactionData['status'],
            $transactionData['accountHolder'],
            $transactionData['card'],
            $transactionData['shippingAddress']
        );
    }

    /**
     * @param Transaction $transaction
     * @return PaymentResponse
     * @throws \Exception
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function processPayment(Transaction $transaction): PaymentResponse
    {
        $request = new PaymentRequest(
            $transaction->getAccountHolder()->getName(),
            $transaction->getTransactionId(),
            'tokenize',
            [
                'accountNumber' => $transaction->getCard()->getAccountNumber(),
                'expirationMonth' => $transaction->getCard()->getExpirationMonth(),
                'expirationYear' => $transaction->getCard()->getExpirationYear(),
                'cardType' => $transaction->getCard()->getCardType(),
                'cardSecurityCode' => $transaction->getCard()->getSecurityCode()
            ]
        );

        $response = $this->client->sendRequest($request);

        if ($response->getTransactionState() === 'success') {
            $transaction->getCard()->tokenize();
            $this->sendNotifications($transaction);
        }

        return $response;
    }

    /**
     * @param $data
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function validateData($data)
    {
        // Implementing data validation logic (for example, checking card numbers, email, etc.)
    }

    /**
     * @param Transaction $transaction
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function sendNotifications(Transaction $transaction)
    {
        // Sending notifications, such as about successful payment
    }
}

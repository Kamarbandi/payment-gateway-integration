<?php

namespace ProviderLibrary;

use ProviderLibrary\Request\PaymentRequest;
use ProviderLibrary\Response\PaymentResponse;
use \Exception;

/**
 * Class Client
 * @package ProviderLibrary
 * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
 */
class Client
{
    public function __construct(readonly string $apiUrl)
    {
    }

    /**
     * @param PaymentRequest $request
     * @return PaymentResponse
     * @throws Exception
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function sendRequest(PaymentRequest $request): PaymentResponse
    {
        $xmlRequest = $request->toXml();

        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: text/xml']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            throw new Exception('Error when sending the request.');
        }

        // Converting XML response to an object
        return PaymentResponse::fromXml($response);
    }
}

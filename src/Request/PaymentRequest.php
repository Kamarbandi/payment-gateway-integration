<?php

namespace ProviderLibrary\Request;

/**
 * Class PaymentRequest
 * @package ProviderLibrary\Request
 * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
 */
class PaymentRequest
{
    private $merchantAccountId;
    private $requestId;
    private $transactionType;
    private $card;

    public function __construct($merchantAccountId, $requestId, $transactionType, $card)
    {
        $this->merchantAccountId = $merchantAccountId;
        $this->requestId = $requestId;
        $this->transactionType = $transactionType;
        $this->card = $card;
    }

    /**
     * @return bool|string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function toXml()
    {
        $xml = new \SimpleXMLElement('<payment></payment>');
        $paymentMethods = $xml->addChild('payment-methods');
        $paymentMethods->addChild('payment-method')->addAttribute('name', 'creditcard');

        $xml->addChild('merchant-account-id', $this->merchantAccountId);
        $xml->addChild('request-id', $this->requestId);
        $xml->addChild('transaction-type', $this->transactionType);

        $cardXml = $xml->addChild('card');
        $cardXml->addChild('account-number', $this->card['accountNumber']);
        $cardXml->addChild('expiration-month', $this->card['expirationMonth']);
        $cardXml->addChild('expiration-year', $this->card['expirationYear']);
        $cardXml->addChild('card-type', $this->card['cardType']);
        $cardXml->addChild('card-security-code', $this->card['cardSecurityCode']);

        return $xml->asXML();
    }
}

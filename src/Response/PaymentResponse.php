<?php

namespace ProviderLibrary\Response;

/**
 * Class PaymentResponse
 * @package ProviderLibrary\Response
 * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
 */
class PaymentResponse
{
    private string $merchantAccountId;
    private string $transactionId;
    private string $transactionState;
    private string $completionTimeStamp;
    private string $cardToken;
    private string $maskedAccountNumber;
    private array $status;
    private string $expirationMonth;
    private string $expirationYear;
    private string $cardType;
    private string $requestId;
    private string $transactionType;

    /**
     * @param $xmlString
     * @return self
     * @throws \Exception
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public static function fromXml($xmlString): self
    {
        $xml = new \SimpleXMLElement($xmlString);

        $response = new self();
        $response->merchantAccountId = (string) $xml->{'merchant-account-id'};
        $response->transactionId = (string) $xml->{'transaction-id'};
        $response->transactionState = (string) $xml->{'transaction-state'};
        $response->completionTimeStamp = (string) $xml->{'completion-time-stamp'};
        $response->cardToken = (string) $xml->{'card-token'}->{'token-id'};
        $response->maskedAccountNumber = (string) $xml->{'card-token'}->{'masked-account-number'};

        if ($xml->statuses && $xml->statuses->status) {
            $response->status = [
                'code' => (string) $xml->statuses->status['code'],
                'description' => (string) $xml->statuses->status['description'],
                'severity' => (string) $xml->statuses->status['severity']
            ];
        }

        if ($xml->card) {
            $response->expirationMonth = (string) $xml->card->{'expiration-month'};
            $response->expirationYear = (string) $xml->card->{'expiration-year'};
            $response->cardType = (string) $xml->card->{'card-type'};
        }

        $response->requestId = (string) $xml->{'request-id'};
        $response->transactionType = (string) $xml->{'transaction-type'};

        return $response;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getMerchantAccountId(): string
    {
        return $this->merchantAccountId;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getTransactionState(): string
    {
        return $this->transactionState;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getCardToken(): string
    {
        return $this->cardToken;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getMaskedAccountNumber(): string
    {
        return $this->maskedAccountNumber;
    }

    /**
     * @return array
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getStatus(): array
    {
        return $this->status;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getExpirationMonth(): string
    {
        return $this->expirationMonth;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getExpirationYear(): string
    {
        return $this->expirationYear;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getCardType(): string
    {
        return $this->cardType;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getTransactionType(): string
    {
        return $this->transactionType;
    }
}

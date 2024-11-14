<?php

namespace ProviderLibrary\Models;

/**
 * Class Transaction
 * @package ProviderLibrary\Models
 * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
 */
class Transaction
{
    public function __construct(
        readonly string $transactionId,
        readonly float $amount,
        readonly string $currency,
        readonly Status $status,
        readonly AccountHolder $accountHolder,
        readonly Card $card,
        readonly ShippingAddress $shippingAddress)
    {
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
     * @return float
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return Status
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return AccountHolder
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getAccountHolder(): AccountHolder
    {
        return $this->accountHolder;
    }

    /**
     * @return Card
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getCard(): Card
    {
        return $this->card;
    }

    /**
     * @return ShippingAddress
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getShippingAddress(): ShippingAddress
    {
        return $this->shippingAddress;
    }
}

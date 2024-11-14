<?php

namespace ProviderLibrary\Models;

/**
 * Class Card
 * @package ProviderLibrary\Models
 * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
 */
class Card
{
    public function __construct(
        private string $accountNumber,
        private string $expirationMonth,
        private string $expirationYear,
        private string $cardType,
        private string $securityCode)
    {
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
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
    public function getSecurityCode(): string
    {
        return $this->securityCode;
    }

    /**
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function tokenize()
    {
        // for tokenize
    }
}

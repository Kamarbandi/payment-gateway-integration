<?php

namespace ProviderLibrary\Models;

/**
 * Class ShippingAddress
 * @package ProviderLibrary\Models
 * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
 */
class ShippingAddress
{
    public function __construct(
        private string $street,
        private string $city,
        private string $postalCode,
        private string $country)
    {
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}

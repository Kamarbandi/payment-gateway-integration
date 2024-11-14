<?php

namespace ProviderLibrary\Models;

/**
 * Class AccountHolder
 * @package ProviderLibrary\Models
 * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
 */
class AccountHolder
{
    public function __construct(
        private string $name,
        private string $email,
        private string $phone
    )
    {
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}

<?php

namespace ProviderLibrary\Models;

/**
 * Class Status
 * @package ProviderLibrary\Models
 * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
 */
class Status
{
    public function __construct(
        private string $code,
        private string $description,
        private string $severity)
    {
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     * @author Azad Kamarbandi <kemerbendiazad@gmail.com>
     */
    public function getSeverity(): string
    {
        return $this->severity;
    }
}
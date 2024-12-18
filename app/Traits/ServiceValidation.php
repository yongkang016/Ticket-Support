<?php

namespace App\Traits;

/**
 * Trait ServiceValidation
 * @package App\Traits
 */
trait ServiceValidation
{
    /**
     * @var string
     */
    private string $scenario;

    /**
     * @var array
     */
    private array $errors = [];

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getImplodeErrors(): string
    {
        return collect($this->errors)->flatten()->implode(", ");
    }

    /**
     * @param string $scenario
     * @return $this
     */
    public function setScenario(string $scenario): static
    {
        $this->scenario = $scenario;
        return $this;
    }

    /**
     * @return string
     */
    public function getScenario(): string
    {
        return $this->scenario;
    }
}

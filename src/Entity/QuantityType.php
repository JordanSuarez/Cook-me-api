<?php

namespace App\Entity;

class QuantityType
{
    /**
     * @var string|null
     */
    private ?string $id;
    /**
     * @var string
     */
    private string $name;

    /**
     * Quantity_Type constructor.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?int
    {
        return $this->name;
    }

    public function setName(?int $name): void
    {
        $this->name = $name;
    }
}

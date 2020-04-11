<?php


namespace App\Entity;

use Ramsey\Uuid\Uuid;
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
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getName(): ?int
    {
        return $this->name;
    }

    /**
     * @param int|null $name
     */
    public function setName(?int $name): void
    {
        $this->name = $name;
    }

}
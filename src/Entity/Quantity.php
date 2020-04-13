<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Quantity.
 *
 * @ORM\Entity(repositoryClass="App/Repository/QuantityRepository")
 */
class Quantity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private string $quantity;

    /**
     * @var
     * @ORM\OneToOne(targetEntity="QuantityType")
     * @ORM\JoinColumn(name="quantity_type_id", referencedColumnName="id")
     */
    private QuantityType $quantityType;

    /**
     * Quantity constructor.
     *
     * @param int|string $quantity
     */
    public function __construct($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getQuantityType()
    {
        return $this->quantityType;
    }

    /**
     * @param mixed $quantityType
     */
    public function setQuantityType($quantityType): void
    {
        $this->quantityType = $quantityType;
    }
}

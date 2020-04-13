<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\QuantityType;

/**
 * Class Quantity.
 * @ORM\Entity(repositoryClass="App/Repository/QuantityRepository")
 * @package App\Entity
 */
class Quantity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var string
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
     * @param int|string $quantity
     */
    public function __construct($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
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

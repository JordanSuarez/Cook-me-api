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
    private string $number;

    /**
     * @var QuantityType
     * @ORM\ManyToOne(targetEntity="QuantityType")
     * @ORM\JoinColumn(name="quantity_type_id", referencedColumnName="id")
     */
    private QuantityType $quantityType;

    /**
     * Number constructor.
     *
     * @param int|string $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
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

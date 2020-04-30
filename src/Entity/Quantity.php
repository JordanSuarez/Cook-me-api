<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Quantity.
 *
 * @ORM\Entity(repositoryClass="App\Repository\QuantityRepository")
 */
class Quantity
{
    const GROUP_QUANTITY = 'group_quantity';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({Quantity::GROUP_QUANTITY})
     */
    private int $id;

    /**
     * @ORM\Column(type="float", nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Positive()
     * @Groups({Quantity::GROUP_QUANTITY})
     */
    private string $number;

    /**
     * @ORM\ManyToOne(targetEntity="QuantityType", inversedBy="quantities")
     * @ORM\JoinColumn(name="quantity_type_id", referencedColumnName="id")
     * @Assert\Type(type="App\Entity\QuantityType")
     */
    private QuantityType $quantityType;

    /**
     * @ORM\OneToOne(targetEntity="Ingredient", mappedBy="quantity", cascade={"persist", "remove"})
     * @Assert\Type(type="App\Entity\Ingredient")
     */
    private Ingredient $ingredient;

    /**
     * Number constructor.
     * @param int|string $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
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

    /**
     * @return Ingredient
     */
    public function getIngredient(): Ingredient
    {
        return $this->ingredient;
    }
}

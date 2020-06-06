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
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Positive()
     * @Groups({Quantity::GROUP_QUANTITY})
     */
    private int $value;

    /**
     * @ORM\ManyToOne(targetEntity="QuantityType")
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
     * Value constructor.
     * @param int|string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
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
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
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

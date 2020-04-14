<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Ingredient.
 *
 * @ORM\Entity(repositoryClass="App/Repository/IngredientRepository")
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=30, unique=true, nullable=false)
     */
    private string $name;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private string $description;
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private \DateTime $createdAt;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \DateTime $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity="Quantity")
     * @ORM\JoinColumn(name="quantity_id", referencedColumnName="id")
     */
    private Quantity $quantity;

    /**
     * @ORM\ManyToMany(targetEntity="Recipe", inversedBy="ingredients")
     * @ORM\JoinTable(name="ingredients_recipes")
     */
    private array $recipes;

    /**
     * Ingredient constructor.
     */
    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
        $this->recipes = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getRecipes(): array
    {
        return $this->recipes;
    }

    public function setRecipes(array $recipes): void
    {
        $this->recipes = $recipes;
    }

    // Add to $recipe array collection

}

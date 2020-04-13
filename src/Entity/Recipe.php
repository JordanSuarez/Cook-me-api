<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Recipe.
 *
 * @ORM\Entity(repositoryClass="App/Repository/RecipeRepository")
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private int $preparationTime;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private string $instruction;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTime $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="RecipeType", inversedBy="recipes")
     * @ORM\JoinColumn(name="recipe_type_id", referencedColumnName="id")
     */
    private RecipeType $recipeType;

    /**
     * @ORM\ManyToMany(targetEntity="Ingredient", inversedBy="recipes")
     */
    private array $ingredients;

    /**
     * Recipe constructor.
     */
    public function __construct(string $name, string $instruction)
    {
        $this->name = $name;
        $this->instruction = $instruction;
        $this->ingredients = new ArrayCollection();
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

    public function getPreparationTime(): int
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(int $preparationTime): void
    {
        $this->preparationTime = $preparationTime;
    }

    public function getInstruction(): string
    {
        return $this->instruction;
    }

    public function setInstruction(string $instruction): void
    {
        $this->instruction = $instruction;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getRecipeType()
    {
        return $this->recipeType;
    }

    /**
     * @param mixed $recipeType
     */
    public function setRecipeType($recipeType): void
    {
        $this->recipeType = $recipeType;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients): void
    {
        $this->ingredients = $ingredients;
    }
}

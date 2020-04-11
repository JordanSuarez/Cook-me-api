<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\RecipeType;

/**
 * Class Recipe.
 * @ORM\Entity(repositoryClass="App/Repository/RecipeRepository")
 */
class Recipe
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
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     */
    private string $name;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private int $preparationTime;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    private string $instruction;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private \DateTime $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \DateTime $updatedAt;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="RecipeType", inversedBy="recipes")
     * @ORM\JoinColumn(name="recipe_type_id", referencedColumnName="id")
     */
    private RecipeType $recipeType;

    /**
     * Recipe constructor.
     *
     * @throws \Exception
     */
    public function __construct(string $name, string $instruction)
    {
        $this->name = $name;
        $this->instruction = $instruction;

    }

    public function getId(): ?string
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
    public function getRecipeType()
    {
        return $this->recipeType;
    }
}

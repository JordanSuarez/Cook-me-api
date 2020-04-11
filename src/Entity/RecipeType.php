<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class RecipeType
 * @ORM\Entity(repositoryClass="App/Repository/RecipeTypeRepository")
 * @package App\Entity
 */
class RecipeType
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
     * @var array
     * @ORM\OneToMany(targetEntity="Recipe", mappedBy="recipeType")
     */
    private array $recipes;

    /**
     * Recipe_Type constructor.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
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

    /**
     * @return array
     */
    public function getRecipes(): array
    {
        return $this->recipes;
    }
}

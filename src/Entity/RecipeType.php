<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class RecipeType.
 *
 * @ORM\Entity(repositoryClass="App\Repository\RecipeTypeRepository")
 */
class RecipeType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"group_recipe_type"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     * @Groups({"group_recipe_type"})
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity="Recipe", mappedBy="recipeType")
     */
    private $recipes;

    /**
     * Recipe_Type constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->recipes = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return
     */
    public function getRecipes()
    {
        return $this->recipes;
    }
}

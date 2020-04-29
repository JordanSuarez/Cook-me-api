<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RecipeType.
 *
 * @ORM\Entity(repositoryClass="App\Repository\RecipeTypeRepository")
 */
class RecipeType
{
    const GROUP_RECIPE_TYPE = 'group_recipe_type';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({RecipeType::GROUP_RECIPE_TYPE})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Type(50)
     * @Assert\Unique()
     * @Groups({RecipeType::GROUP_RECIPE_TYPE})
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

    /**
     * @param Recipe $recipe
     */
    public function addRecipe(Recipe $recipe)
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->add($recipe);
        }
    }

    /**
     * @param Recipe $recipe
     */
    public function removeRecipe(Recipe $recipe)
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
        }
    }
}

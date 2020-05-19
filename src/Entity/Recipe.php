<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Recipe.
 *
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Recipe
{
    const GROUP_RECIPE = 'group_recipe';
    const STARTERS = 1;
    const DISH = 2;
    const DESERTS = 3;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({Recipe::GROUP_RECIPE})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(50)
     * @Groups({Recipe::GROUP_RECIPE})
     */
    private string $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero()
     * @Groups({Recipe::GROUP_RECIPE})
     */
    private ?int $preparationTime;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Groups({Recipe::GROUP_RECIPE})
     */
    private string $instruction;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Groups({Recipe::GROUP_RECIPE})
     */
    private int $type;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private ?DateTime $updatedAt;

    /**
     * @var Ingredient[]
     * @ORM\ManyToMany(targetEntity="Ingredient", inversedBy="recipes")
     * @ORM\JoinTable(name="recipes_ingredients",
     *      joinColumns={@ORM\JoinColumn(name="recipe_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")}
     * )
     */
    private $ingredients;

    /**
     * Recipe constructor.
     * @param string $name
     * @param string $instruction
     */
    public function __construct(string $name, string $instruction)
    {
        $this->name = $name;
        $this->instruction = $instruction;
        $this->ingredients = new ArrayCollection();
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
     * @return int
     */
    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    /**
     * @param int $preparationTime
     */
    public function setPreparationTime(?int $preparationTime): void
    {
        $this->preparationTime = $preparationTime;
    }

    /**
     * @return string
     */
    public function getInstruction(): string
    {
        return $this->instruction;
    }

    /**
     * @param string $instruction
     */
    public function setInstruction(string $instruction): void
    {
        $this->instruction = $instruction;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCreatedAt(): void
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate()
     * @throws Exception
     */
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * @return ArrayCollection
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param array $ingredients
     */
    public function setIngredients(array $ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @param Ingredient $ingredient
     */
    public function addIngredient(Ingredient $ingredient)
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
        }
    }

    /**
     * @param Ingredient $ingredient
     */
    public function removeIngredient(Ingredient $ingredient)
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
        }
    }
}

<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Ingredient.
 *
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Ingredient
{
    const GROUP_INGREDIENT = 'group_ingredient';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({Ingredient::GROUP_INGREDIENT})
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=30, unique=true, nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(30)
     * @Assert\Unique()
     * @Groups({Ingredient::GROUP_INGREDIENT})
     */
    private string $name;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(50)
     * @Groups({Ingredient::GROUP_INGREDIENT})
     */
    private string $description;
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
     * @var Quantity
     * @ORM\OneToOne(targetEntity="Quantity", inversedBy="ingredient", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="quantity_id", referencedColumnName="id")
     * @Assert\Type(type="App\Entity\Quantity")
     */
    private Quantity $quantity;

    /**
     * @var Recipe[]
     * @ORM\ManyToMany(targetEntity="Recipe", mappedBy="ingredients")
     */
    private $recipes;

    /**
     * Ingredient constructor.
     * @param string $name
     * @param string $description
     */
    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
        $this->recipes = new ArrayCollection();
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
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

    /**
     * @return mixed
     */
    public function getRecipes()
    {
        return $this->recipes;
    }

    /**
     * @param Recipe[] $recipes
     */
    public function setRecipes(array $recipes): void
    {
        $this->recipes = $recipes;
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

<?php


namespace App\Entity;

Use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(30)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(30)
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(50)
     * @Assert\Email()
     * @Assert\Unique()
     */
    private string $emailAddress;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private string $password;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private DateTime $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="Recipe")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     */
    private $recipes;

    /**
     * User constructor.
     * @param string $firstName
     * @param string $lastName
     * @param string $emailAddress
     */
    public function __construct(string $firstName, string $lastName, string $emailAddress)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->emailAddress = $emailAddress;
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
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress(string $emailAddress): void
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Recipe
     */
    public function getRecipes(): Recipe
    {
        return $this->recipes;
    }

    /**
     * @param Recipe $recipes
     */
    public function setRecipes(Recipe $recipes): void
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
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
        }
    }
}
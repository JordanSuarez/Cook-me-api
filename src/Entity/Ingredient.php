<?php


namespace App\Entity;

use Ramsey\Uuid\Uuid;

class Ingredient
{
    /**
     * @var string|null
     */
    private ?string $id;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var int
     */
    private int $description;
    /**
     * @var \DateTime
     */
    private \DateTime $createdAt;
    /**
     * @var \DateTime
     */
    private \DateTime $updatedAt;

    /**
     * Ingredient constructor.
     * @param string $name
     * @param int $description
     */
    public function __construct(string $name, int $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getDescription(): int
    {
        return $this->description;
    }

    /**
     * @param int $description
     */
    public function setDescription(int $description): void
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
<?php

namespace App\Entity;

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
     */
    public function __construct(string $name, int $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): int
    {
        return $this->description;
    }

    public function setDescription(int $description): void
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
}

<?php


namespace App\Entity;

use Ramsey\Uuid\Uuid;

class Recipe_Ingredient
{
    /**
     * @var string|null
     */
    private ?string $id;
    /**
     * @var \DateTime
     */
    private \DateTime $createdAt;
    /**
     * @var \DateTime
     */
    private \DateTime $updatedAt;

    /**
     * Recipe_Ingredient constructor.
     * @param string|null $id
     */
    public function __construct(?string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
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
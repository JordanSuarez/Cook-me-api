<?php


namespace App\Entity;


use Ramsey\Uuid\Uuid;

class Recipe
{
    /**
     * @var string|null
     */
    private ?string $id;
    /**
     * @var string
     */
    private string $name;
    private int $preparationTime;
    private string $instruction;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    /**
     * Recipe constructor.
     * @param string $name
     * @param string $instruction
     * @throws \Exception
     */
    public function __construct(string $name, string $instruction)
    {

        $this->id = Uuid::uuid4()->toString();
        $this->name = $name;
        $this->instruction = $instruction;
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
     * @return int
     */
    public function getPreparationTime(): int
    {
        return $this->preparationTime;
    }

    /**
     * @param int $preparationTime
     */
    public function setPreparationTime(int $preparationTime): void
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
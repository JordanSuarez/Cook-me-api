<?php


namespace App\Entity;

use Ramsey\Uuid\Uuid;

class RecipeType
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
     * Recipe_Type constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
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

}
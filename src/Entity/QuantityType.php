<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class QuantityType.
 *
 * @ORM\Entity(repositoryClass="App\Repository\QuantityTypeRepository")
 */
class QuantityType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=30, unique=true, nullable=false)
     */
    private string $name;

    /**
     * QuantityType constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
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
}

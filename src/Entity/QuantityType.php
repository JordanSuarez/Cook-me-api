<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class QuantityType.
 *
 * @ORM\Entity(repositoryClass="App\Repository\QuantityTypeRepository")
 */
class QuantityType
{
    const GROUP_QUANTITY_TYPE = 'group_quantity_type';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({QuantityType::GROUP_QUANTITY_TYPE})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=30, unique=true, nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(30)
     * @Assert\Unique()
     * @Groups({QuantityType::GROUP_QUANTITY_TYPE})
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

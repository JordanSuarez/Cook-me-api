<?php


namespace App\Entity;

use Ramsey\Uuid\Uuid;
class Quantity_Type
{
    /**
     * @var string|null
     */
    private ?string $id;
    /**
     * @var int|null
     */
    private ?int $gram;
    /**
     * @var int|null
     */
    private ?int $centiliter;
    /**
     * @var int|null
     */
    private ?int $piece;
    /**
     * @var int|null
     */
    private ?int $tablespoon;

    /**
     * Quantity_Type constructor.
     * @param int|null $gram
     * @param int|null $centiliter
     * @param int|null $piece
     * @param int|null $tablespoon
     */
    public function __construct(?int $gram, ?int $centiliter, ?int $piece, ?int $tablespoon)
    {
        $this->gram = $gram;
        $this->centiliter = $centiliter;
        $this->piece = $piece;
        $this->tablespoon = $tablespoon;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getGram(): ?int
    {
        return $this->gram;
    }

    /**
     * @param int|null $gram
     */
    public function setGram(?int $gram): void
    {
        $this->gram = $gram;
    }

    /**
     * @return int|null
     */
    public function getCentiliter(): ?int
    {
        return $this->centiliter;
    }

    /**
     * @param int|null $centiliter
     */
    public function setCentiliter(?int $centiliter): void
    {
        $this->centiliter = $centiliter;
    }

    /**
     * @return int|null
     */
    public function getPiece(): ?int
    {
        return $this->piece;
    }

    /**
     * @param int|null $piece
     */
    public function setPiece(?int $piece): void
    {
        $this->piece = $piece;
    }

    /**
     * @return int|null
     */
    public function getTablespoon(): ?int
    {
        return $this->tablespoon;
    }

    /**
     * @param int|null $tablespoon
     */
    public function setTablespoon(?int $tablespoon): void
    {
        $this->tablespoon = $tablespoon;
    }
}
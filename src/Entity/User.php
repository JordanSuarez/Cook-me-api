<?php

declare(strict_types=1);

namespace App\Entity;

use App\Security\Role;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User.
 *
 * @ORM\Entity(repositoryClass="App/Repository/UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=100, unique=true, nullable=false)
     */
    private string $email;

    /**
     * @ORM\Column(type="binary", length=100, nullable=false)
     */
    private string $password;

    /**
     * @ORM\Column(type="simple_array", nullable=false)
     */
    private array $roles;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $token = null;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private \DateTime $createdAt;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \DateTime $updatedAt;

    /**
     * @throws \Exception
     */
    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
        $this->roles[] = Role::ROLE_USER;
        $this->token = \sha1(\uniqid('app'));
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
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

    public function markAsUpdated(): void
    {
        $this->updatedAt = new \DateTime();
    }

    public function getSalt(): void
    {
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
    }

    public function equals(User $user): bool
    {
        return $this->getId() === $user->getId();
    }
}

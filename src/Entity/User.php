<?php


namespace App\Entity;

Use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUser;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
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
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(50)
     */
    private string $username;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $password;

    /**
     * @var array
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * User constructor.
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
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

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

}
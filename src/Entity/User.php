<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTime;

/**
 * Class User.
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="main_user")
 * @ORM\HasLifecycleCallbacks
 */
class User implements UserInterface
{
    public const HALF_ACTIVE = 0;

    public const ACTIVE = 1;

    public const BLOCKED = 2;

    public const DELETED = 3;

    public const USER_STATUS = [
        self::HALF_ACTIVE,
        self::ACTIVE,
        self::BLOCKED,
        self::DELETED,
    ];

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="auth_key", type="string", length=32, nullable=false)
     */
    private $authKey;

    /**
     * @var string
     * @ORM\Column(name="password_hash", type="string", length=255, nullable=false)
     */
    private $passwordHash;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password_reset_token", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $passwordResetToken;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $createdAt;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $updatedAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip", type="string", length=45, nullable=true, options={"default"="NULL"})
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=32, nullable=false)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=32, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=32, nullable=false)
     */
    private $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="middle_name", type="string", length=32, nullable=true, options={"default"="NULL"})
     */
    private $middleName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", length=6, nullable=false)
     */
    private $status;

    /**
     * @var Person|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Person", inversedBy="user")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    protected $person;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * @return Person|null
     */
    public function getPerson(): ?Person
    {
        return $this->person;
    }

    /**
     * @param Person|null $person
     *
     * @return $this
     */
    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthKey(): string
    {
        return $this->authKey;
    }

    /**
     * @param string $authKey
     *
     * @return $this
     */
    public function setAuthKey(string $authKey): self
    {
        $this->authKey = $authKey;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPasswordHash(): ?string
    {
        return $this->passwordHash;
    }

    /**
     * @param string $passwordHash
     *
     * @return $this
     */
    public function setPasswordHash(string $passwordHash): self
    {
        $this->passwordHash = $passwordHash;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPasswordResetToken(): ?string
    {
        return $this->passwordResetToken;
    }

    /**
     * @param string|null $passwordResetToken
     *
     * @return $this
     */
    public function setPasswordResetToken(?string $passwordResetToken): self
    {
        $this->passwordResetToken = $passwordResetToken;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(?DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(?DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Gets triggered only on insert.
     *
     * @ORM\PrePersist
     */
    public function onPrePersist(): void
    {
        $this->createdAt = new DateTime('now');
    }

    /**
     * Gets triggered every time on update.
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate(): void
    {
        $this->updatedAt = new DateTime('now');
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param string|null $ip
     *
     * @return $this
     */
    public function setIp(?string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     *
     * @return $this
     */
    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @param string|null $middleName
     *
     * @return $this
     */
    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return $this
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

//    /**
//     * @return int|null
//     */
//    public function getPersonId(): ?int
//    {
//        return $this->personId;
//    }
//
//    /**
//     * @param int|null $personId
//     *
//     * @return $this
//     */
//    public function setPersonId(?int $personId): self
//    {
//        $this->personId = $personId;
//
//        return $this;
//    }

    /**
     * {@inheritdoc}
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword(): string
    {
        return (string) $this->getPasswordHash();
    }

    /**
     * @param string|null $password
     *
     * @return $this
     */
    public function setPassword(?string $password): self
    {
        $this->passwordHash = $password ?? '';

        return $this;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt(): ?string
    {
        return '';
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     *
     * @return string
     */
    public function eraseCredentials(): string
    {
        return '';
    }
}

<?php
// src/Document/User.php
namespace App\Document;

use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[MongoDB\Document(collection: 'users')]
#[MongoDB\Unique(fields: 'email')]
#[UniqueEntity(
    fields:'email',
    message: 'This email already has an account.'
)]
class User
{
    /**
     * @MongoDB\Id
     */
    #[MongoDB\Id]
    protected string $id;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Assert\Unique]
    protected ?string $email = null;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    protected ?string $password = null;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    protected ?string $name = null;

    #[MongoDB\Field(type: 'date')]
    protected $createdAt = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    // stupid simple encryption (please don't copy it!)
    public function setPassword(?string $password): void
    {
        $this->password = sha1($password);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt = new \DateTime('now'))
    {
        $this->createdAt = $createdAt;
    }


}
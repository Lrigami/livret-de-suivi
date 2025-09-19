<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $lastName = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, Formation>
     */
    #[ORM\ManyToMany(targetEntity: Formation::class, mappedBy: 'student')]
    private Collection $formations;

    /**
     * @var Collection<int, Formation>
     */
    #[ORM\OneToMany(targetEntity: Formation::class, mappedBy: 'teacher')]
    private Collection $teachingFormations;

    /**
     * @var Collection<int, Booklet>
     */
    #[ORM\OneToMany(targetEntity: Booklet::class, mappedBy: 'student')]
    private Collection $booklets;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->teachingFormations = new ArrayCollection();
        $this->booklets = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getFirstName(). ' '. $this->getLastName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'user';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0".self::class."\0password"] = hash('crc32c', $this->password);

        return $data;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
    }

    /**
     * Get the value of firstName
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): static
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->addStudent($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): static
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeStudent($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getTeachingFormations(): Collection
    {
        return $this->teachingFormations;
    }

    public function addTeachingFormation(Formation $teachingFormation): static
    {
        if (!$this->teachingFormations->contains($teachingFormation)) {
            $this->teachingFormations->add($teachingFormation);
            $teachingFormation->setTeacher($this);
        }

        return $this;
    }

    public function removeTeachingFormation(Formation $teachingFormation): static
    {
        if ($this->teachingFormations->removeElement($teachingFormation)) {
            // set the owning side to null (unless already changed)
            if ($teachingFormation->getTeacher() === $this) {
                $teachingFormation->setTeacher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Booklet>
     */
    public function getBooklets(): Collection
    {
        return $this->booklets;
    }

    public function addBooklet(Booklet $booklet): static
    {
        if (!$this->booklets->contains($booklet)) {
            $this->booklets->add($booklet);
            $booklet->setStudent($this);
        }

        return $this;
    }

    public function removeBooklet(Booklet $booklet): static
    {
        if ($this->booklets->removeElement($booklet)) {
            // set the owning side to null (unless already changed)
            if ($booklet->getStudent() === $this) {
                $booklet->setStudent(null);
            }
        }

        return $this;
    }
}

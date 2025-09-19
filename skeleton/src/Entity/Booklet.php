<?php

namespace App\Entity;

use App\Repository\BookletRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookletRepository::class)]
class Booklet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'booklets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $student = null;

    #[ORM\ManyToOne(inversedBy: 'booklets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Formation $formation = null;

    #[ORM\Column]
    private ?bool $archived = null;

    /**
     * @var Collection<int, BookletPeriod>
     */
    #[ORM\OneToMany(targetEntity: BookletPeriod::class, mappedBy: 'booklet', cascade:['persist'])]
    private Collection $bookletPeriods;

    public function __construct()
    {
        $this->bookletPeriods = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?User
    {
        return $this->student;
    }

    public function setStudent(?User $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    public function isArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): static
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * @return Collection<int, BookletPeriod>
     */
    public function getBookletPeriods(): Collection
    {
        return $this->bookletPeriods;
    }

    public function addBookletPeriod(BookletPeriod $bookletPeriod): static
    {
        if (!$this->bookletPeriods->contains($bookletPeriod)) {
            $this->bookletPeriods->add($bookletPeriod);
            $bookletPeriod->setBooklet($this);
        }

        return $this;
    }

    public function removeBookletPeriod(BookletPeriod $bookletPeriod): static
    {
        if ($this->bookletPeriods->removeElement($bookletPeriod)) {
            // set the owning side to null (unless already changed)
            if ($bookletPeriod->getBooklet() === $this) {
                $bookletPeriod->setBooklet(null);
            }
        }

        return $this;
    }
}

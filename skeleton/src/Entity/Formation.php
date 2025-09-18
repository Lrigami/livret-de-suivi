<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $begin_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $end_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $begin_stage_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $end_stage_at = null;

    #[ORM\Column]
    private ?bool $storage = null;

    #[ORM\Column]
    private ?int $nb_hour_center = null;

    #[ORM\Column]
    private ?int $nb_hour_stage = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'formations')]
    private Collection $student;

    #[ORM\ManyToOne(inversedBy: 'teachingFormations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $teacher = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FormationType $type = null;

    /**
     * @var Collection<int, Booklet>
     */
    #[ORM\OneToMany(targetEntity: Booklet::class, mappedBy: 'formation')]
    private Collection $booklets;

    public function __construct()
    {
        $this->student = new ArrayCollection();
        $this->booklets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBeginAt(): ?\DateTimeImmutable
    {
        return $this->begin_at;
    }

    public function setBeginAt(\DateTimeImmutable $begin_at): static
    {
        $this->begin_at = $begin_at;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->end_at;
    }

    public function setEndAt(\DateTimeImmutable $end_at): static
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function getBeginStageAt(): ?\DateTimeImmutable
    {
        return $this->begin_stage_at;
    }

    public function setBeginStageAt(\DateTimeImmutable $begin_stage_at): static
    {
        $this->begin_stage_at = $begin_stage_at;

        return $this;
    }

    public function getEndStageAt(): ?\DateTimeImmutable
    {
        return $this->end_stage_at;
    }

    public function setEndStageAt(\DateTimeImmutable $end_stage_at): static
    {
        $this->end_stage_at = $end_stage_at;

        return $this;
    }

    public function isStorage(): ?bool
    {
        return $this->storage;
    }

    public function setStorage(bool $storage): static
    {
        $this->storage = $storage;

        return $this;
    }

    public function getNbHourCenter(): ?int
    {
        return $this->nb_hour_center;
    }

    public function setNbHourCenter(int $nb_hour_center): static
    {
        $this->nb_hour_center = $nb_hour_center;

        return $this;
    }

    public function getNbHourStage(): ?int
    {
        return $this->nb_hour_stage;
    }

    public function setNbHourStage(int $nb_hour_stage): static
    {
        $this->nb_hour_stage = $nb_hour_stage;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getStudent(): Collection
    {
        return $this->student;
    }

    public function addStudent(User $student): static
    {
        if (!$this->student->contains($student)) {
            $this->student->add($student);
        }

        return $this;
    }

    public function removeStudent(User $student): static
    {
        $this->student->removeElement($student);

        return $this;
    }

    public function getTeacher(): ?User
    {
        return $this->teacher;
    }

    public function setTeacher(?User $teacher): static
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getType(): ?FormationType
    {
        return $this->type;
    }

    public function setType(?FormationType $type): static
    {
        $this->type = $type;

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
            $booklet->setFormation($this);
        }

        return $this;
    }

    public function removeBooklet(Booklet $booklet): static
    {
        if ($this->booklets->removeElement($booklet)) {
            // set the owning side to null (unless already changed)
            if ($booklet->getFormation() === $this) {
                $booklet->setFormation(null);
            }
        }

        return $this;
    }
}

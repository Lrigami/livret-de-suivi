<?php

namespace App\Entity;

use App\Repository\BookletPeriodRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookletPeriodRepository::class)]
class BookletPeriod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bookletPeriods')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Booklet $booklet = null;

    #[ORM\ManyToOne(inversedBy: 'bookletPeriods')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Period $period = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    public function __toString()
    {
        return $this->period ? $this->period->getName() . ' : ' . $this->period->getStartDate()->format('d/m/Y') . ' - ' . $this->period->getEndDate()->format('d/m/Y') : 'Période';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBooklet(): ?Booklet
    {
        return $this->booklet;
    }

    public function setBooklet(?Booklet $booklet): static
    {
        $this->booklet = $booklet;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): static
    {
        $this->period = $period;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }
}

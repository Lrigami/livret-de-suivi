<?php

namespace App\MessageHandler;

use App\Message\ArchiveFormation;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class ArchiveFormationHandler
{
    public function __construct(
        private FormationRepository $formationRepository,
        private EntityManagerInterface $em
    ) {}
    
    public function __invoke(ArchiveFormation $message): void
    {
        $today = new \DateTimeImmutable();

        $formations = $this->formationRepository->findToArchive($today);

        foreach ($formations as $formation) {
            $formation->archive();
        }

        $this->em->flush();
    }
}

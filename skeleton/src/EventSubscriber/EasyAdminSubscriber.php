<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Entity\Period;
use App\Entity\BookletPeriod;
use App\Repository\BookletRepository;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder, FormationRepository $formationRepository, BookletRepository $bookletRepository)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->formationRepository = $formationRepository;
        $this->bookletRepository = $bookletRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => [
                ['addUser', 0],
                ['updateBooklet', 0],
            ],
            BeforeEntityUpdatedEvent::class => [
                ['updateUser', 0],
            ],
        ];
    }

    public function updateUser(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof User)) {
            return;
        }
        $this->setPassword($entity);
    }

    public function addUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof User)) {
            return;
        }
        $this->setPassword($entity);
    }

    /**
     * @param User $entity
     */
    public function setPassword(User $entity): void
    {
        $pass = $entity->getPassword();

        $entity->setPassword(
            $this->passwordEncoder->hashPassword(
                $entity,
                $pass
            )
        );
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function updateBooklet(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Period)) {
            return;
        }

        $this->setBookletPeriods($entity);
    }

    public function setBookletPeriods(Period $entity): void 
    {
        // quand je crée une période je dois update tous les livrets dont la période ajoutée correspond à la période de formation
        // récupérer toutes les formations où période > formation start et < formation end
        $formations = $this->formationRepository->findByDate($entity->getStartDate(), $entity->getEndDate());

        // récupérer tous les livrets de suivi non archivés appartenant aux utilisateurs et à la formation (booklet : id student_id formation_id)
        $booklets = [];
        foreach($formations as $formation) {
            foreach ($this->bookletRepository->findByFormation($formation) as $booklet) {
                $booklets[] = $booklet;
            }
        }
        
        // associer la période ajoutée à chaque livret de suivi (booklet_period : booklet_id period_id)
        foreach($booklets as $booklet) {
            $bookletPeriod = new BookletPeriod();
            $bookletPeriod->setBooklet($booklet);
            $bookletPeriod->setPeriod($entity);
            $this->entityManager->persist($bookletPeriod);
        }
        
        $this->entityManager->flush();
    }

}
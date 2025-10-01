<?php

namespace App\EventSubscriber;

use App\Entity\User;
use RunTimeException;
use App\Entity\Period;
use DateTimeInterface;
use App\Entity\Formation;
use App\Entity\BookletPeriod;
use App\Repository\BookletRepository;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Enum\PeriodType as PeriodTypeEnum;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
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
            ],
            BeforeEntityUpdatedEvent::class => [
                ['updateUser', 0],
            ],
            AfterEntityPersistedEvent::class => [
                ['addFormation', 10],
                ['updateBooklet', -10],
            ]
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

    public function updateBooklet(AfterEntityPersistedEvent $event)
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
            foreach ($this->bookletRepository->findByFormationId($formation->getId()) as $booklet) {
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

    public function addFormation(AfterEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Formation)) {
            return;
        }

        $this->createPeriods($entity);
    }

    public function createPeriods(Formation $entity): void 
    {
        $startDate = $entity->getBeginAt();
        $endDate = $entity->getEndAt();
        $stageStartDate = $entity->getBeginStageAt();
        $stageEndDate = $entity->getEndStageAt();

        $this->createPeriodsInInterval($startDate, $stageStartDate, 'Formation');
        $this->createPeriodsInInterval($stageStartDate, $stageEndDate, 'Stage');
        $this->createPeriodsInInterval($stageEndDate, $endDate, 'Formation');

        $this->entityManager->flush();
    }

    public function createPeriodsInInterval(\DateTimeInterface $start, \DateTimeInterface $end, string $type)
    {
        $periodRepo = $this->entityManager->getRepository(Period::class);

        $current = clone $start;
        $i = 1;

        while($current < $end)
        {
            $endDate = (clone $current)->modify('+5 days');
            if ($endDate > $end) {
                $endDate = clone $end;
            }

            $existingPeriod = $periodRepo->createQueryBuilder('p')
                ->andWhere('p.start_date = :start')
                ->setParameter('start', $current)
                ->getQuery()
                ->getOneOrNullResult();

            if (!$existingPeriod)
            {
                $endDate = (clone $current)->modify('+5 days');
                $period = new Period();
                $period->setStartDate(clone $current);
                $period->setEndDate($endDate);
                $period->setType(PeriodTypeEnum::from($type));
                $period->setName("$type - Semaine $i");

                $this->entityManager->persist($period);
            }

            $current = (clone $current)->modify('+1 week');
            $i++;
        }
    }
}
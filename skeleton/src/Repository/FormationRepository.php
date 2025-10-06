<?php

namespace App\Repository;

use App\Entity\Formation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Formation>
 */
class FormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formation::class);
    }

    public function findByDate($start, $end)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.begin_at <= :startdate')
            ->andWhere('b.end_at >= :enddate')
            ->setParameter('startdate', $start)
            ->setParameter('enddate', $end)
            ->getQuery()
            ->getResult();
    }

    public function findToArchive(\DateTimeImmutable $today): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.end_at < :today')
            ->andWhere('f.isStorage = false')
            ->setParameter('today', $today)
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Formation[] Returns an array of Formation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Formation
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

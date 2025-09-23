<?php

namespace App\Repository;

use App\Entity\Booklet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Booklet>
 */
class BookletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booklet::class);
    }

    public function findByStudentAndFormation($student, $formation): ?Booklet
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.student = :student')
            ->andWhere('b.formation = :formation')
            ->setParameter('student', $student)
            ->setParameter('formation', $formation)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByStudent($student): ?Booklet
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.student = :student')
            ->setParameter('student', $student)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByFormation($formation)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.formation = :formation')
            ->setParameter('formation', $formation)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Booklet[] Returns an array of Booklet objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Booklet
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

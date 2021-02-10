<?php

namespace App\Repository;

use App\Entity\TypeSolutions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeSolutions|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeSolutions|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeSolutions[]    findAll()
 * @method TypeSolutions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeSolutionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeSolutions::class);
    }

    // /**
    //  * @return TypeSolutions[] Returns an array of TypeSolutions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeSolutions
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

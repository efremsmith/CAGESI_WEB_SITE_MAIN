<?php

namespace App\Repository;

use App\Entity\Supports;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Supports|null find($id, $lockMode = null, $lockVersion = null)
 * @method Supports|null findOneBy(array $criteria, array $orderBy = null)
 * @method Supports[]    findAll()
 * @method Supports[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupportsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Supports::class);
    }

    // /**
    //  * @return Supports[] Returns an array of Supports objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Supports
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

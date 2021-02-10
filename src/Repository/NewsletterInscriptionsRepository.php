<?php

namespace App\Repository;

use App\Entity\NewsletterInscriptions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewsletterInscriptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsletterInscriptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsletterInscriptions[]    findAll()
 * @method NewsletterInscriptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsletterInscriptionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsletterInscriptions::class);
    }

    // /**
    //  * @return NewsletterInscriptions[] Returns an array of NewsletterInscriptions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewsletterInscriptions
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

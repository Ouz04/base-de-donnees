<?php

namespace App\Repository;

use App\Entity\Tpays;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tpays|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tpays|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tpays[]    findAll()
 * @method Tpays[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TpaysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tpays::class);
    }

    // /**
    //  * @return Tpays[] Returns an array of Tpays objects
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
    public function findOneBySomeField($value): ?Tpays
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

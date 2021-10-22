<?php

namespace App\Repository;

use App\Entity\TartAdx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TartAdx|null find($id, $lockMode = null, $lockVersion = null)
 * @method TartAdx|null findOneBy(array $criteria, array $orderBy = null)
 * @method TartAdx[]    findAll()
 * @method TartAdx[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TartAdxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TartAdx::class);
    }

    // /**
    //  * @return TartAdx[] Returns an array of TartAdx objects
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
    public function findOneBySomeField($value): ?TartAdx
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

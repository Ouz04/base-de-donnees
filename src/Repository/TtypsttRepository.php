<?php

namespace App\Repository;

use App\Entity\Ttypstt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ttypstt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ttypstt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ttypstt[]    findAll()
 * @method Ttypstt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TtypsttRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ttypstt::class);
    }

    // /**
    //  * @return Ttypstt[] Returns an array of Ttypstt objects
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
    public function findOneBySomeField($value): ?Ttypstt
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

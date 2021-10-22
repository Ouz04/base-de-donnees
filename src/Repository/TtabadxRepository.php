<?php

namespace App\Repository;

use App\Entity\Ttabadx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ttabadx|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ttabadx|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ttabadx[]    findAll()
 * @method Ttabadx[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TtabadxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ttabadx::class);
    }

    // /**
    //  * @return Ttabadx[] Returns an array of Ttabadx objects
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
    public function findOneBySomeField($value): ?Ttabadx
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

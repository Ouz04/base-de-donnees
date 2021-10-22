<?php

namespace App\Repository;

use App\Entity\Ttabpstadx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ttabpstadx|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ttabpstadx|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ttabpstadx[]    findAll()
 * @method Ttabpstadx[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TtabpstadxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ttabpstadx::class);
    }

    // /**
    //  * @return Ttabpstadx[] Returns an array of Ttabpstadx objects
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
    public function findOneBySomeField($value): ?Ttabpstadx
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

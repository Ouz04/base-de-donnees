<?php

namespace App\Repository;

use App\Entity\Ttaxadx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ttaxadx|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ttaxadx|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ttaxadx[]    findAll()
 * @method Ttaxadx[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TtaxadxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ttaxadx::class);
    }

    // /**
    //  * @return Ttaxadx[] Returns an array of Ttaxadx objects
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
    public function findOneBySomeField($value): ?Ttaxadx
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

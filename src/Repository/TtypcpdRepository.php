<?php

namespace App\Repository;

use App\Entity\Ttypcpd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ttypcpd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ttypcpd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ttypcpd[]    findAll()
 * @method Ttypcpd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TtypcpdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ttypcpd::class);
    }

    // /**
    //  * @return Ttypcpd[] Returns an array of Ttypcpd objects
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
    public function findOneBySomeField($value): ?Ttypcpd
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

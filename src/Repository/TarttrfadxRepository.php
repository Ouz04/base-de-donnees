<?php

namespace App\Repository;

use App\Entity\Tarttrfadx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tarttrfadx|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarttrfadx|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarttrfadx[]    findAll()
 * @method Tarttrfadx[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarttrfadxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tarttrfadx::class);
    }

    // /**
    //  * @return Tarttrfadx[] Returns an array of Tarttrfadx objects
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
    public function findOneBySomeField($value): ?Tarttrfadx
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

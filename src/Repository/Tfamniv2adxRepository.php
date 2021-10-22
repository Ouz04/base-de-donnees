<?php

namespace App\Repository;

use App\Entity\Tfamniv2adx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tfamniv2adx|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tfamniv2adx|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tfamniv2adx[]    findAll()
 * @method Tfamniv2adx[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Tfamniv2adxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tfamniv2adx::class);
    }

    // /**
    //  * @return Tfamniv2adx[] Returns an array of Tfamniv2adx objects
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
    public function findOneBySomeField($value): ?Tfamniv2adx
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

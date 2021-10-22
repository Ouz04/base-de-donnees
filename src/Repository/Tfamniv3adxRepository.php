<?php

namespace App\Repository;

use App\Entity\Tfamniv3adx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tfamniv3adx|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tfamniv3adx|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tfamniv3adx[]    findAll()
 * @method Tfamniv3adx[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Tfamniv3adxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tfamniv3adx::class);
    }

    // /**
    //  * @return Tfamniv3adx[] Returns an array of Tfamniv3adx objects
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
    public function findOneBySomeField($value): ?Tfamniv3adx
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

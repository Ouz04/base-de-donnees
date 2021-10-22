<?php

namespace App\Repository;

use App\Entity\Tfamniv1adx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tfamniv1adx|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tfamniv1adx|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tfamniv1adx[]    findAll()
 * @method Tfamniv1adx[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Tfamniv1adxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tfamniv1adx::class);
    }

    // /**
    //  * @return Tfamniv1adx[] Returns an array of Tfamniv1adx objects
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
    public function findOneBySomeField($value): ?Tfamniv1adx
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

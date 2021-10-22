<?php

namespace App\Repository;

use App\Entity\Tgritarett;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tgritarett|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tgritarett|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tgritarett[]    findAll()
 * @method Tgritarett[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TgritarettRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tgritarett::class);
    }

    // /**
    //  * @return Tgritarett[] Returns an array of Tgritarett objects
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
    public function findOneBySomeField($value): ?Tgritarett
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

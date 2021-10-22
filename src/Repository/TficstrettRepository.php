<?php

namespace App\Repository;

use App\Entity\Tficstrett;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tficstrett|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tficstrett|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tficstrett[]    findAll()
 * @method Tficstrett[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TficstrettRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tficstrett::class);
    }

    // /**
    //  * @return Tficstrett[] Returns an array of Tficstrett objects
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
    public function findOneBySomeField($value): ?Tficstrett
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

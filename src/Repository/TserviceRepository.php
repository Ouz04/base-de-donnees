<?php

namespace App\Repository;

use App\Entity\Tservice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tservice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tservice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tservice[]    findAll()
 * @method Tservice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TserviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tservice::class);
    }

    // /**
    //  * @return Tservice[] Returns an array of Tservice objects
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
    public function findOneBySomeField($value): ?Tservice
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

<?php

namespace App\Repository;

use App\Entity\Tbpartner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tbpartner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tbpartner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tbpartner[]    findAll()
 * @method Tbpartner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TbpartnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tbpartner::class);
    }

    // /**
    //  * @return Tbpartner[] Returns an array of Tbpartner objects
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
    public function findOneBySomeField($value): ?Tbpartner
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

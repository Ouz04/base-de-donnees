<?php

namespace App\Repository;

use App\Entity\Tdictab;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tdictab|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tdictab|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tdictab[]    findAll()
 * @method Tdictab[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TdictabRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tdictab::class);
    }

    // /**
    //  * @return Tdictab[] Returns an array of Tdictab objects
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
    public function findOneBySomeField($value): ?Tdictab
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

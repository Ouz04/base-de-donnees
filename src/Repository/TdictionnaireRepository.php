<?php

namespace App\Repository;

use App\Entity\Tdictionnaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tdictionnaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tdictionnaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tdictionnaire[]    findAll()
 * @method Tdictionnaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TdictionnaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tdictionnaire::class);
    }

    // /**
    //  * @return Tdictionnaire[] Returns an array of Tdictionnaire objects
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
    public function findOneBySomeField($value): ?Tdictionnaire
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

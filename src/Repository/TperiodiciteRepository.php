<?php

namespace App\Repository;

use App\Entity\Tperiodicite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tperiodicite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tperiodicite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tperiodicite[]    findAll()
 * @method Tperiodicite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TperiodiciteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tperiodicite::class);
    }

    // /**
    //  * @return Tperiodicite[] Returns an array of Tperiodicite objects
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
    public function findOneBySomeField($value): ?Tperiodicite
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

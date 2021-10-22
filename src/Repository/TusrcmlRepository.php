<?php

namespace App\Repository;

use App\Entity\Tusrcml;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tusrcml|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tusrcml|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tusrcml[]    findAll()
 * @method Tusrcml[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TusrcmlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tusrcml::class);
    }

    // /**
    //  * @return Tusrcml[] Returns an array of Tusrcml objects
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
    public function findOneBySomeField($value): ?Tusrcml
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

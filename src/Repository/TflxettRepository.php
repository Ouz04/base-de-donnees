<?php

namespace App\Repository;

use App\Entity\Tflxett;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tflxett|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tflxett|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tflxett[]    findAll()
 * @method Tflxett[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TflxettRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tflxett::class);
    }

    // /**
    //  * @return Tflxett[] Returns an array of Tflxett objects
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
    public function findOneBySomeField($value): ?Tflxett
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

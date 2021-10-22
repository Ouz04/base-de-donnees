<?php

namespace App\Repository;

use App\Entity\Tctgice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tctgice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tctgice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tctgice[]    findAll()
 * @method Tctgice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TctgiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tctgice::class);
    }

    // /**
    //  * @return Tctgice[] Returns an array of Tctgice objects
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
    public function findOneBySomeField($value): ?Tctgice
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

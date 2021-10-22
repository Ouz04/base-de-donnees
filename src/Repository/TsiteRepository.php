<?php

namespace App\Repository;

use App\Entity\Tsite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tsite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tsite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tsite[]    findAll()
 * @method Tsite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TsiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tsite::class);
    }

    // /**
    //  * @return Tsite[] Returns an array of Tsite objects
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
    public function findOneBySomeField($value): ?Tsite
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

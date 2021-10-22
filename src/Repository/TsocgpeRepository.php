<?php

namespace App\Repository;

use App\Entity\Tsocgpe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tsocgpe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tsocgpe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tsocgpe[]    findAll()
 * @method Tsocgpe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TsocgpeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tsocgpe::class);
    }

    // /**
    //  * @return Tsocgpe[] Returns an array of Tsocgpe objects
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
    public function findOneBySomeField($value): ?Tsocgpe
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

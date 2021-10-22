<?php

namespace App\Repository;

use App\Entity\Tsitweb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tsitweb|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tsitweb|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tsitweb[]    findAll()
 * @method Tsitweb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TsitwebRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tsitweb::class);
    }

    // /**
    //  * @return Tsitweb[] Returns an array of Tsitweb objects
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
    public function findOneBySomeField($value): ?Tsitweb
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

<?php

namespace App\Repository;

use App\Entity\XAct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method XAct|null find($id, $lockMode = null, $lockVersion = null)
 * @method XAct|null findOneBy(array $criteria, array $orderBy = null)
 * @method XAct[]    findAll()
 * @method XAct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XActRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XAct::class);
    }

    // /**
    //  * @return XAct[] Returns an array of XAct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('x.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?XAct
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

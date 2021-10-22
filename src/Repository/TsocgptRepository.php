<?php

namespace App\Repository;

use App\Entity\Tsocgpt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tsocgpt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tsocgpt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tsocgpt[]    findAll()
 * @method Tsocgpt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TsocgptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tsocgpt::class);
    }

    // /**
    //  * @return Tsocgpt[] Returns an array of Tsocgpt objects
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
    public function findOneBySomeField($value): ?Tsocgpt
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

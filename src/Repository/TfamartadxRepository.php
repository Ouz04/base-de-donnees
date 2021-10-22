<?php

namespace App\Repository;

use App\Entity\Tfamartadx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tfamartadx|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tfamartadx|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tfamartadx[]    findAll()
 * @method Tfamartadx[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TfamartadxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tfamartadx::class);
    }

    // /**
    //  * @return Tfamartadx[] Returns an array of Tfamartadx objects
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
    public function findOneBySomeField($value): ?Tfamartadx
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

<?php

namespace App\Repository;

use App\Entity\Tprxach;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tprxach|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tprxach|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tprxach[]    findAll()
 * @method Tprxach[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TprxachRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tprxach::class);
    }

    // /**
    //  * @return Tprxach[] Returns an array of Tprxach objects
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
    public function findOneBySomeField($value): ?Tprxach
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

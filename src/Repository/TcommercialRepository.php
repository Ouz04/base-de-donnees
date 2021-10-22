<?php

namespace App\Repository;

use App\Entity\Tcommercial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tcommercial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tcommercial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tcommercial[]    findAll()
 * @method Tcommercial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TcommercialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tcommercial::class);
    }

    // /**
    //  * @return Tcommercial[] Returns an array of Tcommercial objects
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
    public function findOneBySomeField($value): ?Tcommercial
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

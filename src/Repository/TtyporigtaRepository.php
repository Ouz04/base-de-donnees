<?php

namespace App\Repository;

use App\Entity\Ttyporigta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ttyporigta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ttyporigta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ttyporigta[]    findAll()
 * @method Ttyporigta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TtyporigtaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ttyporigta::class);
    }

    // /**
    //  * @return Ttyporigta[] Returns an array of Ttyporigta objects
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
    public function findOneBySomeField($value): ?Ttyporigta
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

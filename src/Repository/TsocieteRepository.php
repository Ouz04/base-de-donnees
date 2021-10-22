<?php

namespace App\Repository;

use App\Entity\Tsociete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tsociete|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tsociete|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tsociete[]    findAll()
 * @method Tsociete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TsocieteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tsociete::class);
    }

    // /**
    //  * @return Tsociete[] Returns an array of Tsociete objects
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
    public function findOneBySomeField($value): ?Tsociete
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

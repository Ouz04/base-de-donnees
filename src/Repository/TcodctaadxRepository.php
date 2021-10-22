<?php

namespace App\Repository;

use App\Entity\Tcodctaadx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tcodctaadx|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tcodctaadx|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tcodctaadx[]    findAll()
 * @method Tcodctaadx[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TcodctaadxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tcodctaadx::class);
    }

    // /**
    //  * @return Tcodctaadx[] Returns an array of Tcodctaadx objects
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
    public function findOneBySomeField($value): ?Tcodctaadx
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

<?php

namespace App\Repository;

use App\Entity\Tflxpst;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tflxpst|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tflxpst|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tflxpst[]    findAll()
 * @method Tflxpst[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TflxpstRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tflxpst::class);
    }

    // /**
    //  * @return Tflxpst[] Returns an array of Tflxpst objects
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
    public function findOneBySomeField($value): ?Tflxpst
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

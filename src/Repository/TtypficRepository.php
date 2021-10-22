<?php

namespace App\Repository;

use App\Entity\Ttypfic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ttypfic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ttypfic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ttypfic[]    findAll()
 * @method Ttypfic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TtypficRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ttypfic::class);
    }

    // /**
    //  * @return Ttypfic[] Returns an array of Ttypfic objects
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
    public function findOneBySomeField($value): ?Ttypfic
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

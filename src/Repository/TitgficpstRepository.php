<?php

namespace App\Repository;

use App\Entity\Titgficpst;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Titgficpst|null find($id, $lockMode = null, $lockVersion = null)
 * @method Titgficpst|null findOneBy(array $criteria, array $orderBy = null)
 * @method Titgficpst[]    findAll()
 * @method Titgficpst[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TitgficpstRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Titgficpst::class);
    }

    // /**
    //  * @return Titgficpst[] Returns an array of Titgficpst objects
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
    public function findOneBySomeField($value): ?Titgficpst
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

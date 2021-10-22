<?php

namespace App\Repository;

use App\Entity\Trole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trole|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trole|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trole[]    findAll()
 * @method Trole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TroleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trole::class);
    }

    // /**
    //  * @return Trole[] Returns an array of Trole objects
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
    public function findOneBySomeField($value): ?Trole
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

<?php

namespace App\Repository;

use App\Entity\Tdicdta;
use App\Data\SearchBddChp;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tdicdta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tdicdta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tdicdta[]    findAll()
 * @method Tdicdta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TdicdtaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tdicdta::class);
    }
    public function findWithSearch(SearchBddChp $search)
    {
        return $this->createQueryBuilder('tdicdta')
                ->andWhere('tdicdta.tabnam LIKE :string')
                ->setParameter('string', '%'.$search.'%')
                ->getQuery()
                ->execute();
               
        // $query=$this->createQueryBuilder('t')
        // ->select('p.tabnam','p.id','p.rng','p.chpnam','p.ctq','p.typ','p.dsg','p.usrIns','p.datIns');
      
       
            
        //     if(!empty($search->string)){
        //         $query=$query
        //               ->andWhere('p.name LIKE :string')
        //               ->setParameter('string', '%($search->string)%')
        //               ->setMaxResults(1);

        //     }
        //     return $query->getQuery()->getResult();

    }

    // /**
    //  * @return Tdicdta[] Returns an array of Tdicdta objects
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
    public function findOneBySomeField($value): ?Tdicdta
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

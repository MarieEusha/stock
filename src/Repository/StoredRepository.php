<?php

namespace App\Repository;

use App\Entity\Stored;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stored|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stored|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stored[]    findAll()
 * @method Stored[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StoredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stored::class);
    }

    // /**
    //  * @return Stored[] Returns an array of Stored objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stored
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

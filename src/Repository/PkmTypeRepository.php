<?php

namespace App\Repository;

use App\Entity\PkmType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PkmType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PkmType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PkmType[]    findAll()
 * @method PkmType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PkmTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PkmType::class);
    }

    // /**
    //  * @return PkmType[] Returns an array of PkmType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PkmType
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

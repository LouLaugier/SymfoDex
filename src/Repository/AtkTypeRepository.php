<?php

namespace App\Repository;

use App\Entity\AtkType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AtkType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AtkType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AtkType[]    findAll()
 * @method AtkType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AtkTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AtkType::class);
    }

    // /**
    //  * @return AtkType[] Returns an array of AtkType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AtkType
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Build;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Build|null find($id, $lockMode = null, $lockVersion = null)
 * @method Build|null findOneBy(array $criteria, array $orderBy = null)
 * @method Build[]    findAll()
 * @method Build[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuildRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Build::class);
    }

    public function whereCurrentYear(QueryBuilder $qb) {
        $qb->andWhere('b.date BETWEEN :start AND :end')
           ->setParameter('start', new \Datetime(date('Y').'-01-01'))
           ->setParameter('end', new \Datetime(date('Y').'-12-31'));
    }

    public function getBuilds($page, $nbPerPage) {
        $query = $this->createQueryBuilder('b')
            ->leftJoin('b.image', 'i')
            ->addSelect('i')
            ->orderBy('b.date', 'DESC')
            ->getQuery();

        $query->setFirstResult(($page-1)* $nbPerPage)
              ->setMaxResults($nbPerPage);

        return new Paginator($query, true);
    }

    // /**
    //  * @return Build[] Returns an array of Build objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Build
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

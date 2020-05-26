<?php

namespace App\Repository;

use App\Entity\Ability;
use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ability|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ability|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ability[]    findAll()
 * @method Ability[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbilityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ability::class);
    }

    public function getAbilitiesByPokemonId($pokemonId) {
        
        //SELECT a.* FROM ability a INNER JOIN pokemon_ability pa ON a.id = pa.ability_id INNER JOIN pokemon p ON pa.pokemon_id = p.id WHERE p.id = $pokemonId;
    }

    // /**
    //  * @return Ability[] Returns an array of Ability objects
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
    public function findOneBySomeField($value): ?Ability
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

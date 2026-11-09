<?php

namespace App\Repository;

use App\Entity\Oeuvres;
use App\Entity\Artistes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Oeuvres>
 */
class OeuvresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oeuvres::class);
    }

//    /**
//     * @return Oeuvres[] Returns an array of Oeuvres objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Oeuvres
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

/**
 * @return Oeuvres[]
 */
public function findByArtiste(Artistes $artiste): array
{
    return $this->createQueryBuilder('o')
        ->andWhere(':artiste MEMBER OF o.artistes')
        ->setParameter('artiste', $artiste)
        ->orderBy('o.date_creation', 'ASC')
        ->getQuery()
        ->getResult();
}

}

<?php

namespace App\Repository;

use App\Entity\GeoCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GeoCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeoCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeoCode[]    findAll()
 * @method GeoCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeoCodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GeoCode::class);
    }

    // /**
    //  * @return GeoCode[] Returns an array of GeoCode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GeoCode
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

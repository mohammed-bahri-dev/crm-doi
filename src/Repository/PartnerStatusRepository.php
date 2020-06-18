<?php

namespace App\Repository;

use App\Entity\PartnerStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PartnerStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartnerStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartnerStatus[]    findAll()
 * @method PartnerStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartnerStatus::class);
    }

    // /**
    //  * @return PartnerStatus[] Returns an array of PartnerStatus objects
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
    public function findOneBySomeField($value): ?PartnerStatus
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

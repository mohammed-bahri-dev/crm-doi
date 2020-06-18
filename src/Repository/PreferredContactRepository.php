<?php

namespace App\Repository;

use App\Entity\PreferredContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PreferredContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method PreferredContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method PreferredContact[]    findAll()
 * @method PreferredContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreferredContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PreferredContact::class);
    }

    // /**
    //  * @return PreferredContact[] Returns an array of PreferredContact objects
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
    public function findOneBySomeField($value): ?PreferredContact
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

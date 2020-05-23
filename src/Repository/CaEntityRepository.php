<?php

namespace App\Repository;

use App\Entity\CaEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CaEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaEntity[]    findAll()
 * @method CaEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CaEntity::class);
    }

    // /**
    //  * @return CaEntity[] Returns an array of CaEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CaEntity
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

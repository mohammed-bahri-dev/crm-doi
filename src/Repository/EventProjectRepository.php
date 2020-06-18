<?php

namespace App\Repository;

use App\Entity\EventProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EventProject|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventProject|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventProject[]    findAll()
 * @method EventProject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventProject::class);
    }

    // /**
    //  * @return EventProject[] Returns an array of EventProject objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventProject
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

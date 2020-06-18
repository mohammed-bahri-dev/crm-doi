<?php

namespace App\Repository;

use App\Entity\TypeOfEventProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeOfEventProject|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeOfEventProject|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeOfEventProject[]    findAll()
 * @method TypeOfEventProject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeOfEventProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeOfEventProject::class);
    }

    // /**
    //  * @return TypeOfEventProject[] Returns an array of TypeOfEventProject objects
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
    public function findOneBySomeField($value): ?TypeOfEventProject
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

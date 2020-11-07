<?php

namespace App\Repository;

use App\Entity\DocumentModele;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocumentModele|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentModele|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentModele[]    findAll()
 * @method DocumentModele[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentModeleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentModele::class);
    }

    // /**
    //  * @return DocumentModele[] Returns an array of DocumentModele objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DocumentModele
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

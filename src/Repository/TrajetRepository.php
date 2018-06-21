<?php

namespace App\Repository;

use App\Entity\Trajet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Trajet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trajet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trajet[]    findAll()
 * @method Trajet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrajetRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Trajet::class);
    }

//    /**
//     * @return Trajet[] Returns an array of Trajet objects
//     */

    public function findSelectedTrajet($trajetId)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.vehicule', 'v')
            ->addSelect('v')
            ->innerJoin('v.marque', 'ma')
            ->addSelect('ma')
            ->innerJoin('ma.modeles', 'mo')
            ->addSelect('mo')
            ->innerJoin('v.membre', 'me')
            ->addSelect('me')
            ->innerJoin('t.etapes', 'e')
            ->addSelect('e')
            ->innerJoin('e.adresse', 'a')
            ->addSelect('a')
            ->andWhere('t.id = :id')
            ->setParameter('id', $trajetId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findArray($array)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.id IN (:array)')
            ->setParameter('array', $array)
            ->getQuery()
            ->getOneOrNullResult();
    }
    /*
    public function findOneBySomeField($value): ?Trajet
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

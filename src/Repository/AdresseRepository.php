<?php

namespace App\Repository;

use App\Entity\Adresse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Adresse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adresse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adresse[]    findAll()
 * @method Adresse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdresseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Adresse::class);
    }

    public function rechercheTrajet($depart, $dest)
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.lieudepart like :depart')
            ->setParameter('depart', $depart)
            ->andWhere('a.lieudestination like :dest')
            ->setParameter('dest', $dest)
            ->leftJoin('a.etapes', 'e')
            ->addSelect('e')
            ->leftJoin('e.trajet', 't')
            ->addSelect('t')
            ->leftJoin('t.membre', 'm')
            ->addSelect('m')
            ->leftJoin('m.membre', 'u')
            ->addSelect('u')
            ->orderBy('a.lieudepart', 'ASC')
            ->getQuery();

        return $qb->execute();
    }
}

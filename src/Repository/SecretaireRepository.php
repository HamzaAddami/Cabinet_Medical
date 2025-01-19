<?php

namespace App\Repository;

use App\Entity\Secretaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * @extends ServiceEntityRepository<Secretaire>
 */
class SecretaireRepository extends ServiceEntityRepository
{
    public const SECRETARE_PER_PAGE = 6;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Secretaire::class);
    }

    //    /**
    //     * @return Secretaire[] Returns an array of Secretaire objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Secretaire
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findAllSecretaires(int $page = 1): Paginator
    {
        $query = $this->createQueryBuilder('s')
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->setFirstResult(($page - 1) * self::SECRETARE_PER_PAGE)
            ->setMaxResults(self::SECRETARE_PER_PAGE);

        return new Paginator($query);
    }
}

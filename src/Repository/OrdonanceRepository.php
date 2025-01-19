<?php

namespace App\Repository;

use App\Entity\Ordonance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * @extends ServiceEntityRepository<Ordonance>
 */
class OrdonanceRepository extends ServiceEntityRepository
{
    public const ORDONNANCE_PER_PAGE = 8;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ordonance::class);
    }

    //    /**
    //     * @return Ordonance[] Returns an array of Ordonance objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Ordonance
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findAllOrdonances(int $page = 1): Paginator
    {
        $query = $this->createQueryBuilder('o')
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->setFirstResult(($page - 1) * self::ORDONNANCE_PER_PAGE)
            ->setMaxResults(self::ORDONNANCE_PER_PAGE);

        return new Paginator($query);
    }
}

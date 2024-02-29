<?php

namespace App\Repository;

use App\Entity\LigneEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LigneEvaluation>
 *
 * @method LigneEvaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneEvaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneEvaluation[]    findAll()
 * @method LigneEvaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneEvaluation::class);
    }

    //    /**
    //     * @return LigneEvaluation[] Returns an array of LigneEvaluation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?LigneEvaluation
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

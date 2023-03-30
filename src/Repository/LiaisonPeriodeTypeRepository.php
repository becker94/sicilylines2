<?php

namespace App\Repository;

use App\Entity\LiaisonPeriodeType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LiaisonPeriodeType>
 *
 * @method LiaisonPeriodeType|null find($id, $lockMode = null, $lockVersion = null)
 * @method LiaisonPeriodeType|null findOneBy(array $criteria, array $orderBy = null)
 * @method LiaisonPeriodeType[]    findAll()
 * @method LiaisonPeriodeType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LiaisonPeriodeTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LiaisonPeriodeType::class);
    }

    public function save(LiaisonPeriodeType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LiaisonPeriodeType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LiaisonPeriodeType[] Returns an array of LiaisonPeriodeType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LiaisonPeriodeType
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\UserCollector;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Admin;

/**
 * @extends ServiceEntityRepository<UserCollector>
 *
 * @method UserCollector|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCollector|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCollector[]    findAll()
 * @method UserCollector[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCollectorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCollector::class);
    }

    public function add(UserCollector $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserCollector $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findUserController(Admin $Admin): array
    {
        return $this->createQueryBuilder('c')
        ->select('col.Name','col.id','c.can_edit')
        ->innerJoin('c.Collector', 'col')
        ->andWhere('c.Admin  = :val')
        ->setParameter('val', $Admin)
        ->getQuery()
        ->getResult();
    }

    public function can_edit(Admin $Admin,int $controllerId): bool
    {
        $query= $this->createQueryBuilder('c')
        ->andWhere('c.Admin  = :val')
        ->setParameter('val', $Admin)
        ->andWhere('c.Collector  = :val2')
        ->setParameter('val2', $controllerId)
        ->getQuery()
        ->getResult();
        
        foreach($query as $el){
            return $el->getCanEdit();
        }
        return false;
    }

//    /**
//     * @return UserCollector[] Returns an array of UserCollector objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserCollector
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

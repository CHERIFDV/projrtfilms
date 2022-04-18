<?php

namespace App\Repository;

use App\Entity\Ouevre;
use Doctrine\ORM\ORMException;
use Monolog\DateTimeImmutable;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Ouevre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ouevre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ouevre[]    findAll()
 * @method Ouevre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OuevreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ouevre::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Ouevre $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function hide(Ouevre $entity, bool $flush = true): void
    {
        //$this->_em->remove($entity);
        $this->_em->persist($entity->setDeletedAt(new \DateTimeImmutable()));
        if ($flush) {
            $this->_em->flush();
        }
    }

    
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Ouevre $entity, bool $flush = true): void
    {
        //$this->_em->remove($entity);
        $this->_em->persist($entity->setDeletedAt(new \DateTimeImmutable()));
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Ouevre[] Returns an array of Ouevre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ouevre
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

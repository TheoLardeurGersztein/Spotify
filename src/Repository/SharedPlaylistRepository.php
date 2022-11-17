<?php

namespace App\Repository;

use App\Entity\SharedPlaylist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SharedPlaylist>
 *
 * @method SharedPlaylist|null find($id, $lockMode = null, $lockVersion = null)
 * @method SharedPlaylist|null findOneBy(array $criteria, array $orderBy = null)
 * @method SharedPlaylist[]    findAll()
 * @method SharedPlaylist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SharedPlaylistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SharedPlaylist::class);
    }

    public function save(SharedPlaylist $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SharedPlaylist $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SharedPlaylist[] Returns an array of SharedPlaylist objects
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

//    public function findOneBySomeField($value): ?SharedPlaylist
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

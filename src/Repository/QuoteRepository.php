<?php

namespace App\Repository;

use App\Entity\Quote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Quote>
 */
class QuoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quote::class);
    }

    public function findBySearch(array $item) : array {
        $result = $this->createQueryBuilder('q')
                ->where('1 = 0')
                ->innerJoin("q.client_id", 'c');
        if(!empty($item['date_created'])) {
            $result ->orwhere('q.date_created LIKE :date_created')
                    ->setParameter('date_created', '%'.$item['date_created'].'%');
        } if(!empty($item['total_ht'])) {
            $result ->orWhere('q.total_ht LIKE :total_ht')
                    ->setParameter('total_ht', '%'.$item['total_ht'].'%');
        } if(!empty($item['total_ttc'])) {
            $result ->orWhere('q.total_ttc LIKE :total_ttc')
                    ->setParameter('total_ttc', '%'.$item['total_ttc'].'%');
        } if(!empty($item['total_tva'])) {
            $result ->orWhere('q.total_tva LIKE :total_tva')
                    ->setParameter('total_tva', '%'.$item['total_tva'].'%');
        } if(!empty($item['client'])) {
            $result ->orWhere('c.name LIKE :client')
                    ->setParameter('client', '%'.$item['client'].'%');
        } if(!empty($item['status'])) {
            $result ->orWhere('q.status LIKE :status')
                    ->setParameter('status', '%'.$item['status'].'%');
        }
        $result = $result ->getQuery()
                          ->getResult();

        return $result ?: [];
    }

//    /**
//     * @return Quote[] Returns an array of Quote objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Quote
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\Invoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Invoice>
 */
class InvoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }

    public function findBySearch(array $item) : array {
        $result = $this->createQueryBuilder('i')
                ->where('1 = 0')
                ->innerJoin("i.client_id", 'c');
        if(!empty($item['name'])) {
            $result ->orwhere('c.name LIKE :name')
                    ->setParameter('name', '%'.$item['name'].'%');
        } if(!empty($item['phone'])) {
            $result ->orWhere('c.phone LIKE :phone')
                    ->setParameter('phone', '%'.$item['phone'].'%');
        } if(!empty($item['email'])) {
            $result ->orWhere('c.email LIKE :email')
                    ->setParameter('email', '%'.$item['email'].'%');
        } if(!empty($item['address'])) {
            $result ->orWhere('c.address LIKE :address')
                    ->setParameter('address', '%'.$item['address'].'%');
        }
        $result = $result ->getQuery()
                          ->getResult();

        return $result ?: [];
    }

    //    /**
    //     * @return Invoice[] Returns an array of Invoice objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Invoice
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

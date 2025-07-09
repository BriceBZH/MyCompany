<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function findBySearch(array $item) : array {
        $result = $this->createQueryBuilder('c');
        $result->where('1 = 0');
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
    //     * @return Client[] Returns an array of Client objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Client
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

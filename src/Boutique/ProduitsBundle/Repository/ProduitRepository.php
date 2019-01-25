<?php

namespace Boutique\ProduitsBundle\Repository;

/**
 * ProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitRepository extends \Doctrine\ORM\EntityRepository
{
    public function sortProductByPrice() {

        $query = $this->createQueryBuilder('p')
                      ->orderBy('p.price', 'ASC')
                      ->getQuery();
        return $query->execute();
    }

    public function sortProductByName($name) {

        $query = $this->createQueryBuilder('p')
                      ->Where('p.name LIKE :name' )
                      ->setParameter('name', '%' . $name . '%')
                      ->getQuery();
        return $query->execute();

    }

    
}

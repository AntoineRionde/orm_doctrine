<?php

namespace catadoct\catalog\domain\Repository;

use catadoct\catalog\domain\entities\Produit;
use Doctrine\ORM\EntityRepository;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[] findAll()
 * @method Produit[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends EntityRepository
{
    function findProductsByKeyword($keyword)
    {
        $produits = $this->matching(
            Criteria::create()
                ->where(Criteria::expr()->contains("description", $keyword))
        );
        return $produits;
    }
}

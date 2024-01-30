<?php

namespace catadoct\catalog\domain\repository;

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
    private string $path = "\\catadoct\\catalog\\domain\\entities\\Produit";

    public function findProducts(): array
    {
        $dql = "SELECT p, t FROM $this->path p
                JOIN p.tarifs t";
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getResult();
    }

    public function findByKeyword(string $keyword): array
    {
        $dql = "SELECT p FROM $this->path p
                WHERE p.libelle LIKE :keyword
                OR p.description LIKE :keyword";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('keyword', "%$keyword%");
        return $query->getResult();
    }

    public function findByLowerPrice(float $price): array
    {
        $dql = "SELECT p, t FROM $this->path p
                JOIN p.tarifs t
                WHERE t.tarif <= :price
                ORDER BY p.numero ASC";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('price', $price);
        return $query->getResult();
    }

    public function findByNumberAndSize(int $number, string $size) : array {
        $dql = "SELECT p, t, ta FROM $this->path p
                JOIN p.tarifs t
                JOIN t.taille ta
                WHERE p.numero = :number
                AND ta.libelle = :size";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('number', $number);
        $query->setParameter('size', $size);
        return $query->getResult();
    }
}

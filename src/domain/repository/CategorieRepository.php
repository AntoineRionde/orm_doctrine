<?php

namespace catadoct\catalog\domain\repository;

use catadoct\catalog\domain\entities\Categorie;
use Doctrine\ORM\EntityRepository;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[] findAll()
 * @method Categorie[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends EntityRepository
{
}

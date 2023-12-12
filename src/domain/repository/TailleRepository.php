<?php

namespace catadoct\catalog\domain\repository;

use catadoct\catalog\domain\entities\Taille;
use Doctrine\ORM\EntityRepository;

/**
 * @method Taille|null find($id, $lockMode = null, $lockVersion = null)
 * @method Taille|null findOneBy(array $criteria, array $orderBy = null)
 * @method Taille[] findAll()
 * @method Taille[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TailleRepository extends EntityRepository
{
}

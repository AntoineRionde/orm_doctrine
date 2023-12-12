<?php

namespace catadoct\catalog\domain\repository;

use catadoct\catalog\domain\entities\Tarif;
use Doctrine\ORM\EntityRepository;

/**
 * @method Tarif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarif[] findAll()
 * @method Tarif[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarifRepository extends EntityRepository
{
}

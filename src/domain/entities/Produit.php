<?php


namespace catadoct\catalog\domain\entities;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Tests\ORM\Tools\Pagination\Category;

#[Entity]
#[Table(name: "produit")]
class Produit {

    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue(strategy: "AUTO")]
    private int $id;

    #[Column(type: Types::INTEGER)]
    private int $numero;

    #[Column(type: Types::STRING)]
    private string $libelle;

    #[Column(type: Types::STRING)]
    private string $description;

    #[Column(type: Types::STRING)]
    private string $image;

    #[ManyToOne(targetEntity: Categorie::class)]
    #[JoinColumn(name: "categorie_id", referencedColumnName: "id")]
    private ?Category $categorie;

    #[OneToMany(targetEntity: Tarif::class, mappedBy: "produit")]
    private Collection $tarifs;
}
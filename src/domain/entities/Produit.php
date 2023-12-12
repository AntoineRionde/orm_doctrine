<?php


namespace catadoct\catalog\domain\entities;

use catadoct\catalog\domain\repository\ProduitRepository;
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

#[Entity(repositoryClass: ProduitRepository::class)]
#[Table(name: "produit")]
class Produit {

    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue(strategy: "AUTO")]
    public int $id;

    #[Column(type: Types::INTEGER)]
    public int $numero;

    #[Column(type: Types::STRING)]
    public string $libelle;

    #[Column(type: Types::TEXT)]
    public string $description;

    #[Column(type: Types::STRING)]
    public string $image;

    #[ManyToOne(targetEntity: Categorie::class)]
    #[JoinColumn(name: "categorie_id", referencedColumnName: "id")]
    public ?Categorie $categorie;

    #[OneToMany(mappedBy: "produit", targetEntity: Tarif::class)]
    public Collection $tarifs;
}
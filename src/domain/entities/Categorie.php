<?php

namespace catadoct\catalog\domain\entities;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
#[Table(name: "taille")]
class Categorie
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: "id", type: Types::INTEGER)]
    private int $id;


    #[Column(name: "libelle", type: Types::STRING)]
    private string $libelle;

    #[OneToMany(targetEntity: Produit::class, mappedBy: "categorie")]
    private Collection $produits;
}
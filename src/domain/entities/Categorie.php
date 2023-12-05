<?php

namespace catadoct\catalog\domain\entities;
use catadoct\catalog\domain\Repository\CategorieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: CategorieRepository::class)]
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
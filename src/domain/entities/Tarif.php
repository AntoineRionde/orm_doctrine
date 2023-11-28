<?php

namespace catadoct\catalog\domain\entities;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

#[Entity]
#[Table(name: "tarif")]
class Tarif
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: "id", type: Types::INTEGER)]
    private int $id;


    #[Column(name: "tarif", type: Types::FLOAT)]
    private float $tarif;

    #[ManyToOne(targetEntity: Taille::class)]
    #[JoinColumn(name: "taille_id", referencedColumnName: "id")]
    private ?Taille $taille;

    #[ManyToOne(targetEntity: Produit::class)]
    #[JoinColumn(name: "produit_id", referencedColumnName: "id")]
    private ?Produit $produit;
}
<?php

namespace catadoct\catalog\domain\entities;
use catadoct\catalog\domain\repository\TailleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: TailleRepository::class)]
#[Table(name: "taille")]
class Taille
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: "id", type: Types::INTEGER)]
    public int $id;

    #[Column(name: "libelle", type: Types::STRING)]
    public string $libelle;

    #[OneToMany(targetEntity: Tarif::class, mappedBy: "taille")]
    public Collection $tarifs;
}
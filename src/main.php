<?php
require_once __DIR__ . '/../vendor/autoload.php';

use catadoct\catalog\domain\entities\Categorie;
use catadoct\catalog\domain\entities\Produit;
use Doctrine\Common\Collections\Criteria;

$entityManager = require_once __DIR__ . '/../src/manager/manager.php';

// question 1
$produitRepository = $entityManager->getRepository(Produit::class);
$produit = $produitRepository->find(4);
echo $produit->getNumero();
echo $produit->getLibelle();
echo $produit->getDescription();
echo $produit->getImage();

// question 2
$categorieRepository = $entityManager->getRepository(Categorie::class);
$categorie = $categorieRepository->find(5);
echo $categorie->getLibelle();

// question 3
echo $produit->categorie->getLibelle();

// question 4
$produits = $categorie->matching(Criteria::create()->where(Criteria::expr()->eq('categorie', 5)));
foreach ($produits as $produit) {
    echo $produit->getLibelle();
}

// question 5 : Créer un produit et le relier à la catégorie 5, faire en sorte qu'il soit sauvegardé dans la base
$produit = new Produit();
$produit->setNumero(1);
$produit->setLibelle('produit 1');
$produit->setDescription('description produit 1');
$produit->setImage('image produit 1');
$produit->setCategorie($categorie);
$entityManager->persist($produit);
$entityManager->flush();

// question 6 : Modifier ce produit et mettre à jour la base
$produit->setLibelle('produit 1 modifié');
$entityManager->persist($produit);
$entityManager->flush();

// question 7 : Supprimer ce produit de la base
$entityManager->remove($produit);
$entityManager->flush();

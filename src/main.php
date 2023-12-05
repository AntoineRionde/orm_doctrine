<?php
require_once __DIR__ . '/../vendor/autoload.php';

$entityManager = require_once __DIR__ . '/../src/manager/manager.php';

use Doctrine\Common\Collections\Criteria;

// question 1
$produitRepository = $entityManager->getRepository('catadoct\catalog\domain\entities\Produit');
$produit = $produitRepository->find(4);
echo $produit->getNumero();
echo $produit->getLibelle();
echo $produit->getDescription();
echo $produit->getImage();

// question 2
$categorieRepository = $entityManager->getRepository('catadoct\catalog\domain\entities\Categorie');
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

// Exercice 2 : requêtes
// question 1 : afficher le produit dont le numéro est 4
$produit = $produitRepository->findOneBy(['numero' => 4]);
echo $produit->getLibelle();

// question 2 : afficher le produit numéro 5 et de libelleé 'Pepperoni' s'il existe
$produit = $produitRepository->findOneBy(['numero' => 5, 'libelle' => 'Pepperoni']);
echo $produit->getLibelle();

// question 3 : Afficher la catégorie de libellé 'Boissons' ainsi que les produits de cette catégorie
$categorie = $categorieRepository->findOneBy(['libelle' => 'Boissons']);
echo $categorie->getLibelle();
$produits = $categorie->getProduits();
foreach ($produits as $produit) {
    echo $produit->getLibelle();
}

// question 4
$produits = $produitRepository->findProductsByKeyword('mozzarella');
foreach ($produits as $produit) {
    echo $produit->getLibelle();
}

// question 5 :  afficher les produits de la catégorie 5 contenant 'jambon' dans la description
$produits = $produitRepository->findProductsByKeyword('jambon')->matching(Criteria::create()->where(Criteria::expr()->eq('categorie', 5)));
foreach ($produits as $produit) {
    echo $produit->getLibelle();
}
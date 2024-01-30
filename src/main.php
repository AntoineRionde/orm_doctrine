<?php
require_once __DIR__ . '/../vendor/autoload.php';

use catadoct\catalog\domain\entities\Categorie;
use catadoct\catalog\domain\entities\Produit;
use Doctrine\Common\Collections\Criteria;

$entityManager = require_once __DIR__ . '/../src/manager/manager.php';

// method to do a line
function line(int $number)
{
    echo "\n------------------- Question $number ---------------------\n\n";
}

function printProduit(Produit $produit)
{
    echo "Produit n° $produit->numero: $produit->libelle \n";
    echo "Categorie : " . $produit->categorie->libelle . "\n";
    echo "Description: $produit->description \n";
    echo "Image: $produit->image \n";
}

function printCategory(Categorie $categorie)
{
    echo "Categorie n° $categorie->id: $categorie->libelle \n";
}

function findNotUsedNumero($entityManager): int
{
    $produitRepository = $entityManager->getRepository(Produit::class);
    $criteria = Criteria::create()
        ->orderBy(['numero' => 'DESC'])
        ->setMaxResults(1);
    $produit = $produitRepository->matching($criteria)->first();
    return $produit->numero + 1;
}

// Exercice 1
// Question 1
line(1);
$produitRepository = $entityManager->getRepository(Produit::class);
$produit = $produitRepository->find(4);
printProduit($produit);

// Question 2
line(2);
$categorieRepository = $entityManager->getRepository(Categorie::class);
$categorie = $categorieRepository->find(5);
printCategory($categorie);

// Question 4
line(4);
$produits = $produitRepository->findBy(['categorie' => 5]);
foreach ($produits as $produit) {
    printProduit($produit);
    echo "\n";
}

// Question 5
line(5);
$produit = new Produit();
$produit->numero = findNotUsedNumero($entityManager);
$produit->libelle = 'produit 1';
$produit->description = 'description produit 1';
$produit->image = 'image produit 1';
$entityManager->persist($produit);
$entityManager->flush();
echo "Produit n° $produit->numero créé \n";

// Question 6
line(6);
$produit->libelle = 'produit 1 modifié';
$entityManager->persist($produit);
$entityManager->flush();
echo "Produit n° $produit->numero modifié \n";

// Question 7
line(7);
$entityManager->remove($produit);
$entityManager->flush();
echo "Produit n° $produit->numero supprimé \n";

// Exercice 2
// Question 1

line(1);
$produit = $produitRepository->find(4);
printProduit($produit);

// Question 2
line(2);
$produit = $produitRepository->findOneBy(['libelle' => 'Pepperoni', 'numero' => 5]);
if ($produit) {
    printProduit($produit);
} else {
    echo "Produit non trouvé \n";
}

// Question 3
line(3);
$categorie = $categorieRepository->findOneBy(['libelle' => 'Boissons']);
$produits = $produitRepository->findBy(['categorie' => $categorie->id]);
foreach ($produits as $produit) {
    printProduit($produit);
    echo "\n";
}

// Question 4
line(4);
// find produits with mozarrella in description (use criteria)
$criteria = Criteria::create()
    ->where(Criteria::expr()->contains('description', 'mozzarella'));
$produits = $produitRepository->matching($criteria);
foreach ($produits as $produit) {
    printProduit($produit);
    echo "\n";
}

// Question 5
line(5);
$criteria = Criteria::create()
    ->where(Criteria::expr()->contains('description', 'jambon'));
$categorie = $categorieRepository->find(5)
    ->produits
    ->matching($criteria);
foreach ($categorie as $produit) {
    printProduit($produit);
    echo "\n";
}

// Exercice 3
// Question 1
line(1);
$produits = $produitRepository->findProducts();
foreach ($produits as $produit) {
    printProduit($produit);
    foreach ($produit->tarifs as $tarif) {
        echo "Tarif n°$tarif->id : $tarif->tarif € \n";
    }
    echo "\n";
}

// Question 2
line(2);
$produits = $produitRepository->findByKeyword("mozzarella");
foreach ($produits as $produit) {
    printProduit($produit);
}

// Question 3
$produitRepository = $entityManager->getRepository(Produit::class);
$produits = $produitRepository->findByLowerPrice(4);
foreach ($produits as $produit) {
    printProduit($produit);
    foreach ($produit->tarifs as $tarif) {
        echo "Tarif n°$tarif->id : $tarif->tarif € \n";
    }
}

// Question 4
line(4);
$produitRepository = $entityManager->getRepository(Produit::class);
$produits = $produitRepository->findByNumberAndSize(10, "grande");

foreach ($produits as $produit) {
    printProduit($produit);
    foreach ($produit->tarifs as $tarif) {
        echo "Tarif n°$tarif->id pour la taille " . $tarif->taille->libelle . ": $tarif->tarif € \n";
    }
}
<?php
require_once __DIR__ . '/../vendor/autoload.php';

$entityManager = require_once __DIR__ . '/../src/manager/manager.php';
$produitRepository = $entityManager->getRepository('catadoct\catalog\domain\entities\Produit');
$produit = $produitRepository->find(4);
echo $produit->getNom();
<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

$a = new Manager\Application;
$a -> run();


// TEST 1 : Entity :
// $produit = new Entity\Produit; 
// $produit -> setTitre('Mon super produit');
// echo $produit -> getTitre();

// $membre = new Entity\Membre; 
// $membre -> setPseudo('Yakine');
// echo $membre -> getPseudo();
// url à tester : http://localhost/PHPoo/13-Framework/web/


// TEST 2 : PDOManager :
// $pdom = Manager\PDOManager::getInstance(); 
// $pdo = $pdom -> getPdo();
// $resultat = $pdo -> query("SELECT * FROM produit");
// $produits = $resultat -> fetchAll(); 

// echo '<pre>';
// print_r($produits);
// echo '</pre>';


// TEST 3 : Model
// Attention pour tester la classe model, nous avons du forcer la fonction getTableName() à nous retourner un nom de table. Après les tests il faut rétablir le traitement original de la fonction. 
//$model = new Model\Model;
//$produits = $model -> findAll();
//$produit = $model -> find(10);
//
//echo '<pre>';
//print_r($produit);
//print_r($produits);
//echo '</pre>';

// TEST 4 ProduitModel
//$pm = new \Model\ProduitModel();
//
//echo '<pre>';
//print_r($pm ->getAllProduct());
//print_r($pm ->getProduitById(40));
//print_r($pm ->getAllCategory());
//print_r($pm ->getAllProductByCategory('Manteau'));
//echo '</pre>';

//// TEST 5 : ProduitController
//$pc = new \Controller\ProduitController();
//$pc -> afficheAll();

//// TEST 5.2 : ProduitController
//$pc = new \Controller\ProduitController();
//$pc -> boutique('Chaussures');

// TEST 5.3 : ProduitController
//$pc = new \Controller\ProduitController();
//$pc -> affiche('37');


// TEST 6 : ProduitController
//index.php?controller=produit&action=afficheall
//index.php?controller=produit&action=boutique&arg=manteau
//index.php?controller=produit&action=affiche&arg=37

//$controller = 'Controller\\' . $_GET['controller'] . 'Controller';
//$action     = $_GET['action'];
//
//if(isset($_GET['arg']))
//{
//    $arg = $_GET['arg'];
//}
//else
//{
//    $arg = NULL;
//}
//
//$a = new $controller;
//$a -> $action($arg);

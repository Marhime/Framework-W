<?php

namespace Controller;

class ProduitController extends Controller
{

    // Afficher tous les produits (home)
    public function afficheAll()
    {
        //1 : Récuperer tous les produits
        //2 : Récuperer toutes les catégories
        //3 : Renvoyer la vue (boutique.php)

        $produits = $this ->getModel() -> getAllProduct();
        $categories = $this ->getModel() -> getAllCategory();

        return $this ->render('layout.html', 'boutique.html', array(
            'produits' => $produits,
            'categories' => $categories
        ));
    }

    //Afficher un produit (fiche_produit)
    public function affiche($id)
    {
        //1. Recuperer les infos du produit dont l'id est $id
        //2. Renvoyer la vue

        $produit = $this ->getModel() -> getProduitById($id);
        $produitsSug = $this -> getModel() -> getSuggestionsProduit($id);



        return $this ->render('layout.html', 'fiche_produit.html', array(
            'produit' => $produit,
            'produitsSug' => $produitsSug

        ));

    }

    // Afficher les produits d'une catégorie (boutique/catégorie)
    public function boutique($cat)
    {
        //1 : Récuperer tous les produits de la catégorie ($cat)
        //2 : Récuperer toutes les catégories
        //3 : Renvoyer la vue (boutique.php)

        $produits = $this ->getModel() -> getAllProductByCategory($cat);
        $categories = $this ->getModel() -> getAllCategory();

        return $this ->render('layout.html', 'boutique.html', array(
            'produits' => $produits,
            'categories' => $categories
        ));
    }

    //afficher les produits en fonction d'une recherche
    public function recherche(){
        if($_POST){
            if(!empty($_POST['term'])){

                $produits = $this -> getModel() -> getProduitBySearch($_POST['term']);

                return $this ->render('layout.html', 'search.html', array(
                    'produits' => $produits,
                    'title' => count($produits) . ' résultats avec la recherche :<b> ' . $_POST['term'] . '</b>'
                ));
            }
            else{
                $this -> afficheAll();
            }
        }
    }



}
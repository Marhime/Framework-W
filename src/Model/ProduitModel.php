<?php

namespace Model;

use PDO;

class ProduitModel extends Model
{
    // Tout le code de Model.php est ici

    public function getAllProduct()
    {
        return $this ->findAll();
    }

    public function getProduitById($id)
    {
        return $this ->find($id);
    }

    public function updateProduit($id, $infos)
    {
        return $this->update($id, $infos);
    }

    public function deleteProduit($id)
    {
        return $this ->delete($id);
    }

    public function registerProduit($infos)
    {
        return $this ->register($infos);
    }

    public function getAllCategory()
    {
        $requete = "SELECT DISTINCT categorie FROM produit";
        $resultat = $this->getDb() ->query($requete);

        $donnees = $resultat ->fetchAll();

        if(!$donnees)
        {
            return FALSE;
        } else
        {
            return $donnees;
        }
    }

    public function getAllProductByCategory($cat)
    {
        $requete = "SELECT * FROM produit WHERE categorie = :cat";
        $resultat = $this ->getDb() ->prepare($requete);
        $resultat ->bindValue(':cat', $cat, PDO::PARAM_STR);
        $resultat ->execute();

        $donnees = $resultat ->setFetchMode(PDO::FETCH_CLASS, 'Entity\Produit');

        $donnees = $resultat -> fetchAll();

        if(!$donnees)
        {
            return FALSE;
        }
        else{
            return $donnees;
        }
    }

    public function getProduitBySearch($term){

        $term = '%' . $term . '%';

        $requete = "
        SELECT *
        FROM produit
        WHERE titre LIKE :term
        OR description LIKE :term
        OR categorie LIKE :term
        OR taille LIKE :term
        OR prix LIKE :term
        ";

        $resultat = $this ->getDb() ->prepare($requete);
        $resultat ->bindValue(':term', $term, PDO::PARAM_STR);
        $resultat ->execute();

        $donnees = $resultat ->setFetchMode(PDO::FETCH_CLASS, 'Entity\Produit');

        $donnees = $resultat -> fetchAll();

        if(!$donnees)
        {
            return FALSE;
        }
        else{
            return $donnees;
        }

    }

    public function getSuggestionsProduit($id){

        $pdt = $this -> getProduitById($id);
        $cat = $pdt -> getCategorie();
        $taille = $pdt -> getTaille();
        $prix = $pdt -> getPrix();
        $public = $pdt -> getPublic();
        $idd = $pdt -> getId_Produit();

        $requete = "
        SELECT *
        FROM produit
        WHERE categorie LIKE '$cat'
        AND taille LIKE  '$taille'
        AND prix LIKE '$prix'
        AND public LIKE '$public'
        AND id_produit != '$idd'";

        $resultat = $this->getDb() ->query($requete);

        $donnees = $resultat ->fetchAll();

        if(!$donnees)
        {
            return FALSE;
        } else
        {
            return $donnees;
        }



    }

}
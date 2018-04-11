<?php

namespace Model;

use PDO;

class MembreModel extends Model
{
    // Tout le code de Model.php est ici

    public function getMembreByPseudo($pseudo){
        $requete = "SELECT * FROM membre WHERE pseudo = :pseudo";
        $resultat = $this -> getDb() -> prepare($requete);
        $resultat -> bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $resultat -> execute();

        $resultat -> setFetchMode(PDO::FETCH_CLASS, 'Entity\Membre');

        $donnees = $resultat -> fetch();

        if(!$donnees){
            return FALSE;
        }
        else{
            return $donnees;
        }
    }

    public function registerMembre($infos){
        return $this -> register($infos);
    }

    public function getAllMembre()
    {
        return $this ->findAll();
    }

    public function getMembreById($id)
    {
        return $this ->find($id);
    }

    public function updateMembre($id, $infos)
    {
        return $this->update($id, $infos);
    }

    public function deleteMembre($id)
    {
        return $this ->delete($id);
    }

}
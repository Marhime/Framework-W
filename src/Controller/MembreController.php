<?php

namespace Controller;

class MembreController extends Controller
{
    public function profil(){

        if($_SESSION){

            $membre = $_SESSION['membre'];

            $params = array(
                'membre' => $membre,
                'title' => 'Profil' . $_SESSION['membre']['pseudo']
            );

            return $this -> render('layout.html', 'profil.html', $params);

        }

    }

    public function inscription(){

        $erreur = '';

        if($_POST)
        {

            if($this ->getModel() -> getMembreByPseudo($_POST['pseudo']))
            {
                $erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Pseudo indisponible </div>';
            }
            if(strlen($_POST['pseudo'])< 2 || strlen($_POST['pseudo'])> 20)
            {
                $erreur.= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille du pseudo non valide </div>';
            }
            if(strlen($_POST['mdp'])< 5 || strlen($_POST['mdp'])> 60)
            {
                $erreur.= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille du mot de passe non valide </div>';
            }
            if(strlen($_POST['prenom'])< 2 || strlen($_POST['prenom'])> 20)
            {
                $erreur.= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille du prenom non valide </div>';
            }
            if(strlen($_POST['nom'])< 2 || strlen($_POST['nom'])> 20)
            {
                $erreur.= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille du nom non valide </div>';
            }
            if(strlen($_POST['email'])< 2 || strlen($_POST['email'])> 50)
            {
                $erreur.= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille de l\'email non valide </div>';
            }
            if(strlen($_POST['ville'])< 2 || strlen($_POST['ville'])> 20)
            {
                $erreur.= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille de la ville non valide </div>';
            }
            if(!is_numeric($_POST['code_postal']) || strlen($_POST['code_postal'])!==5)
            {
                $erreur.= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Code Postal non valide </div>';
            }
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $erreur.= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Email non valide </div>';
            }

            if(empty($erreur))
            {
                if($this -> getModel() -> registerMembre($_POST))
                {
                    $erreur .= '<div class="alert alert-success col-md-8 col-md-offset-2 text-center">Vous êtes inscris sur notre site web ! <a href="<?= $url ?>connexion.html" class="alert-link">Cliquez ici pour vous connecter</a></div>';
                }
            }
        }

        $params = array(
            'erreur' => $erreur,
            'title' => 'Inscription'
        );

        return $this -> render('layout.html', 'inscription.html', $params);


    }



    public function connexion(){

        $erreur = '';

        if($_POST)
        {
            $membre = $this -> getModel() -> getMembreByPseudo($_POST['pseudo']);

            if($membre) // si le membre existe :
            {
                if($_POST['mdp'] == $membre -> getMdp()) // on controle que le mot de passe saisie par l'internaute est le même qui celui présent en BDD
                {
                    $this -> createSessionMembre($membre);

                    header("location:" . $this -> url . "membre/profil"); // ayant les bons identifiants on le redirige vers sa page profil
                }
                else // sinon l'internaute a saisie un mauvais mdp
                {
                    $erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Mauvais mot de passe!</div>';
                }
            }
            else
            {
                $erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Casse toi pauv\' con!</div>';
            }
        }

        $params = array(
            'erreur' => $erreur,
            'title' => 'Connexion'
        );

        return $this -> render('layout.html', 'connexion.html', $params);

    }

    public function createSessionMembre($membre){
                $_SESSION['membre']['id_membre'] = $membre -> getId_membre();
                $_SESSION['membre']['pseudo'] = $membre -> getPseudo();
                $_SESSION['membre']['prenom'] = $membre -> getPrenom();
                $_SESSION['membre']['nom'] = $membre -> getNom();
                $_SESSION['membre']['email'] = $membre -> getEmail();
                $_SESSION['membre']['ville'] = $membre -> getVille();
                $_SESSION['membre']['adresse'] = $membre -> getAdresse();
                $_SESSION['membre']['code_postal'] = $membre -> getCode_postal();
                $_SESSION['membre']['statut'] = $membre -> getStatut();
                $_SESSION['membre']['civilite'] = $membre -> getCivilite();
        }

    public function deconnexion(){

    }

    public function newsletter(){}
    public function parrainer(){}

}
<?php

//vendor/Manager/Application.php

namespace Manager;

final class Application
{
    protected $controller; // Le controller à instancier
    protected $action; // L'action à lancer
    protected $argument = NULL; // L'argument s'il y en a un

    public function __construct() // On scan l'URL
    {
        $tab = explode('/', $_SERVER['REQUEST_URI']);

//        echo '<pre>';
//        print_r($tab);
//        echo '</pre>';

        if(isset($tab[4]) && !empty($tab[4]) && file_exists(__DIR__ . '/../../src/Controller/' . ucfirst($tab[4]) . 'Controller.php'))
        {
            // S'il y a un controller xxxxx dans l'url et que le fichier xxxxxController.php existe

            $this -> controller = 'Controller\\' . ucfirst($tab[4]) . 'Controller';
        }
        else
        {
            $this -> controller = 'Controller\ProduitController';
        }

        if(isset($tab[5]) && !empty($tab[5]))
        {
            $this -> action = $tab[5];
        }
        else
        {
            $this -> controller = 'Controller\ProduitController';
            $this -> action = 'afficheAll';
        }
        //--------
        if(isset($tab[6]) && !empty($tab[6]))
        {
            $this -> argument = $tab[6];
        }

    }

    public function run() // Lance les instanciations / App
    {
        if(!is_null($this -> controller))
        {
            $a = new $this -> controller;

            if(!is_null($this ->action) && method_exists($a, $this ->action))
            {
                $action = $this -> action;
                $a -> $action($this -> argument);
                //$a -> afficheAll
                //$a -> affiche(10)
            }
        }
        else
        {
            require __DIR__ . '/../../src/View/404.html';
        }

    }
}
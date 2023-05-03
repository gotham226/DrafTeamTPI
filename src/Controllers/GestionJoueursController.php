<?php

namespace drafteam\Controllers;

session_start();

class GestionJoueursController
{
    public function gestionJoueurs()
    {
        if(!isset($_SESSION['entraineur'])){

            header('Location: /');
            
        }
        require_once('../src/Views/gestionJoueurs.php');
    }
}
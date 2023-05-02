<?php


namespace drafteam\Controllers;

session_start();

class AccueilController
{
    public function accueil()
    {
        

        require_once('../src/Views/accueil.php');
    }
}
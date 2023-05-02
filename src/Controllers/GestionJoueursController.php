<?php

namespace drafteam\Controllers;

session_start();

class GestionJoueursController
{
    public function gestionJoueurs()
    {
        require_once('../src/Views/gestionJoueurs.php');
    }
}
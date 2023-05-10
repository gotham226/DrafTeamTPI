<?php
/**
 * Auteur: Gabriel Martin
 * Date: 04.05.2023
 * Description: Page controller pour la page de gestion de joueurs
 * Version 1.0
 */
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
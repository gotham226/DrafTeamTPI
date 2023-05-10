<?php
/**
 * Auteur: Gabriel Martin
 * Date: 02.05.2023
 * Description: Page controller pour la page de déconnexion
 * Version 1.0
 */
namespace drafteam\Controllers;



session_start();

class DeconnexionController
{
    public function deconnexion()
    {
        if(!isset($_SESSION['email'])){

            header('Location: /');
            
        }
        session_destroy();
        header('Location: /');
        exit;
    }

}
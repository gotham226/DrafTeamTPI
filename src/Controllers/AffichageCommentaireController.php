<?php
/**
 * Auteur: Gabriel Martin
 * Date: 11.05.2023
 * Description: Page controller pour la page affichage des commentaires
 * Version 1.0
 */

namespace drafteam\Controllers;

use drafteam\Models\EventModel;

session_start();

class AffichageCommentaireController
{
    public function affichageCommentaire()
    {
        if(!isset($_SESSION['entraineur'])){
            header('Location: /');
            exit;
        }
        
        require_once('../src/Views/affichageCommentaire.php');
    }

}
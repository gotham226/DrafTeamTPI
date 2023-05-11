<?php
/**
 * Auteur: Gabriel Martin
 * Date: 11.05.2023
 * Description: Page controller pour la page de modification du score
 * Version 1.0
 */
namespace drafteam\Controllers;
use drafteam\Models\EventModel;

session_start();

class ModifierScoreController
{
    public function modifierScore()
    {
        if(!isset($_SESSION['entraineur'])){

            header('Location: /');
            exit;
        }

        if(isset($_SESSION['idEquipe']) == null){
            header('Location: /');
            exit;
        }
        $error ="";
        $score = EventModel::selectEventById($_GET['idEvenement'])['resultat'];
        $scores = explode(" - ", $score);
        $score1 = $scores[0];
        $score2 = $scores[1];   

        $domicile = filter_input(INPUT_POST, 'domicile', FILTER_SANITIZE_STRING);
        $exterieur = filter_input(INPUT_POST, 'exterieur', FILTER_SANITIZE_STRING);

        if(isset($_POST['validerEnregistrer']))
        {
            if($domicile != "" && $exterieur != "")
            {
                $resultat = $domicile." - ".$exterieur;
                EventModel::setScore($_GET['idEvenement'], $resultat);
                header("Location: /evenement?idEvenement=".$_GET['idEvenement']);
                exit;
            }
        }

        require_once('../src/Views/modifierScore.php');
    }

}
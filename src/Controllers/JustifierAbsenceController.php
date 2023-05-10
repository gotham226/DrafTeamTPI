<?php
/**
 * Auteur: Gabriel Martin
 * Date: 10.05.2023
 * Description: Page controller pour la page de justification au absences
 * Version 1.0
 */
namespace drafteam\Controllers;


use drafteam\Models\EventModel;


session_start();

class JustifierAbsenceController
{
    public function justification()
    {
        $raison = filter_input(INPUT_POST, 'raison', FILTER_SANITIZE_STRING);
        $error = "";


        if(isset($_POST['annuler']))
        {
            header('Location: /evenement?idEvenement='.$_GET['idEvenement']);
            exit;
        }

        
        if(isset($_POST['valider']))
        {
            if($raison != "")
            {
                EventModel::metAbsentAvecRaison($_SESSION['idSportif'], $_GET['idEvenement'], $raison);
                header('Location: /evenement?idEvenement='.$_GET['idEvenement']);
                exit;
            }else{
                $error = "Vous devez entrez une raison à votre absence";
            }
            
            
        }

        

        
        require_once('../src/Views/justifierAbsence.php');
    }

    
}
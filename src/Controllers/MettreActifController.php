<?php
/**
 * Auteur: Gabriel Martin
 * Date: 04.05.2023
 * Description: Page controller pour la page d'activation de championnats
 * Version 1.0
 */
namespace drafteam\Controllers;
use drafteam\Models\EquipeModel;
use drafteam\Models\ChampionnatModel;

session_start();

class MettreActifController
{
    public function mettreActif()
    {

        if(!isset($_SESSION['entraineur'])){
            header('Location: /');
            exit;
        }

        if(isset($_POST['annuler']))
        {
            header('Location: /championnat');
            exit;
        }

        $message = "";
        $message2 = "";

        if(isset($_GET['idChampionnat']))
        {
            $message = "Veux-tu vraiment rejoindre ce championnat ?";
            $message2 = "En activant ce championnat, cela désactivera le championnat en cours pour votre équipe";
            if(isset($_POST['oui']))
            {
                
                ChampionnatModel::desactiverChampionnat($_GET['idChampionnat'], $_SESSION['idEquipe']);
                header('Location: /championnat');
                exit;

            }
        }else{
            $message = "Veux-tu vraiment quitter ce championnat ?";
            if(isset($_POST['oui']))
            {
                

                ChampionnatModel::desactiverChampionnat($_GET['idChampionnatDesactiver'], $_SESSION['idEquipe'], 1);
                header('Location: /championnat');
                exit;
            }
                
        }
        

        require_once('../src/Views/actif.php');
    }
}
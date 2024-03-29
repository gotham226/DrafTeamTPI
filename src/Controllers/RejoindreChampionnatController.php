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

class RejoindreChampionnatController
{
    public function rejoindreChampionnat()
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
        $message = 'Veux tu vraiment rejoindre ce championnat ?';
        $message2= "";

        if(isset($_POST['oui']))
        {
            
            ChampionnatModel::desactiverChampionnat($_GET['idChampionnat'], $_SESSION['idEquipe']);
            header('Location: /championnat');
            exit;
        }

        require_once('../src/Views/actif.php');
    }
}
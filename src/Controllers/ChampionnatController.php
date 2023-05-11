<?php
/**
 * Auteur: Gabriel Martin
 * Date: 02.05.2023
 * Description: Page controller pour la page championnat
 * Version 1.0
 */

namespace drafteam\Controllers;

use drafteam\Models\ChampionnatModel;

session_start();

class ChampionnatController
{
    public function championnat()
    {
        if(!isset($_SESSION['email'])){
            header('Location: /');
            exit;
        }
        

        $championnats = ChampionnatModel::selectAllChampionnatFromIdCoach($_SESSION['idSportif']);
        $idChampionnatActif = "";

        if(isset($_SESSION['idEquipe']))
        {
            $idChampionnatActif = ChampionnatModel::isActive($_SESSION['idEquipe']);
        }

        $championnatsActif = ChampionnatModel::selectChampionnatByID($idChampionnatActif);

        $autreChampionnats = ChampionnatModel::selectOthersChampionnat($_SESSION['idSportif']);


        

        require_once('../src/Views/championnat.php');
    }

}
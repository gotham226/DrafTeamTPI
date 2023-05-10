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

        $idChampionnatActif = ChampionnatModel::isActive();
        

        $championnatsActif = ChampionnatModel::selectChampionnatByID($idChampionnatActif);


        

        require_once('../src/Views/championnat.php');
    }

}
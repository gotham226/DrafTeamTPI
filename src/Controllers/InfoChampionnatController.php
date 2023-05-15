<?php
/**
 * Auteur: Gabriel Martin
 * Date: 02.05.2023
 * Description: Page controller pour la page d'info sur les championnats
 * Version 1.0
 */
namespace drafteam\Controllers;

use drafteam\Models\ChampionnatModel;
use drafteam\Models\EquipeModel;


session_start();

class InfoChampionnatController
{
    public function infoChampionnat()
    {
        if(!isset($_SESSION['email'])){
            header('Location: /');
            exit;
        }

        
        
        $championnat = ChampionnatModel::selectChampionnatByID($_GET['idChampionnat']);

        $equipes = EquipeModel::selectATeamByIdChampionnat($_GET['idChampionnat']);


        require_once('../src/Views/infoChampionnat.php');
    }

}
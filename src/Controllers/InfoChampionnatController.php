<?php

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

        if(isset($_SESSION['idEquipe']) == null)
        {
            header('Location: /');
            exit;
        }
        
        $championnat = ChampionnatModel::selectChampionnatByID($_GET['idChampionnat']);

        $equipes = EquipeModel::selectATeamByIdChampionnat($_GET['idChampionnat']);


        require_once('../src/Views/infoChampionnat.php');
    }

}
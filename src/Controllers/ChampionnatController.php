<?php

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

        require_once('../src/Views/championnat.php');
    }

}
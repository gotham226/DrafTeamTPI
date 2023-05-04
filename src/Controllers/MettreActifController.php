<?php

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

        if(isset($_POST['oui']))
        {
            
            ChampionnatModel::desactiverChampionnat($_GET['idChampionnat'], $_SESSION['idEquipe']);
            header('Location: /championnat');
            exit;
        }

        require_once('../src/Views/actif.php');
    }
}
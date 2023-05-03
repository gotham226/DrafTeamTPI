<?php

namespace drafteam\Controllers;

use drafteam\Models\ChampionnatModel;

session_start();

class ModifierChampionnatController
{
    public function modifierChampionnat()
    {
        if(!isset($_SESSION['entraineur']))
        {
            header('Location: /');
            exit;
        }

        $nomChampionnat = filter_input(INPUT_POST, 'nomChampionnat', FILTER_SANITIZE_STRING);

        $error = "";

        if(isset($_POST['modifier']))
        {
            ChampionnatModel::UpdateChampionnatById($nomChampionnat, $_GET['idChampionnat']);
            header('Location: /championnat');
            exit;
        }

        $championnat = ChampionnatModel::selectChampionnatByID($_GET['idChampionnat']);
        
        require_once('../src/Views/modifierChampionnat.php');
    }

    
}
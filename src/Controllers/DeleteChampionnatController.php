<?php
/**
 * Auteur: Gabriel Martin
 * Date: 03.05.2023
 * Description: Page controller pour la page de suppression de championnat
 * Version 1.0
 */
namespace drafteam\Controllers;

use drafteam\Models\ChampionnatModel;

session_start();

class DeleteChampionnatController
{
    public function deleteChampionnat()
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
            ChampionnatModel::deleteChampionnatById($_GET['idChampionnat']);
            $_GET['idChampionnat'] = null;
            header('Location: /championnat');
            exit;
        }

        
        require_once('../src/Views/deleteChampionnat.php');
    }

    
}
<?php
/**
 * Auteur: Gabriel Martin
 * Date: 03.05.2023
 * Description: Page controller pour la page equipe
 * Version 1.0
 */
namespace drafteam\Controllers;

use drafteam\Models\EquipeModel;
use drafteam\Models\UserModel;
use drafteam\Models\LieuModel;
use drafteam\Models\PosteModel;

session_start();

class EquipeController
{
    public function equipe()
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
        
        $monEquipe = EquipeModel::selectATeamById($_SESSION['idEquipe']);

        $monCoach = UserModel::takeTheCoach($_SESSION['idEquipe']);

        $mesJoueurs = UserModel::takePlayerByIdEquipe($_SESSION['idEquipe']);

        $monStaff = UserModel::takeStaffByIdEquipe($_SESSION['idEquipe']);

        

        

        

        require_once('../src/Views/monEquipe.php');
    }

}
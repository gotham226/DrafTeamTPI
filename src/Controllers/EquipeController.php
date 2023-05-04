<?php

namespace drafteam\Controllers;

use drafteam\Models\EquipeModel;
use drafteam\Models\UserModel;
use drafteam\Models\LieuModel;

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
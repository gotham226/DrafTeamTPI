<?php

namespace drafteam\Controllers;

use drafteam\Models\EquipeModel;
use drafteam\Models\UserModel;


session_start();

class DeleteEquipeController
{
    public function deleteEquipe()
    {
        if(!isset($_SESSION['entraineur'])){
            header('Location: /');
            exit;
        }

        if(isset($_POST['annuler']))
        {
            header('Location: /monEquipe');
            exit;
        }

        if(isset($_POST['oui']))
        {

            
            UserModel::deleteUserByIdEquipe($_GET['idEquipe']);
            EquipeModel::deleteTeamById($_GET['idEquipe']);
            $_GET['idEquipe'] = null;
            $_SESSION['idEquipe'] = null;

            header('Location: /');
            exit;
        }

        
        require_once('../src/Views/deleteEquipe.php');
    }

    
}
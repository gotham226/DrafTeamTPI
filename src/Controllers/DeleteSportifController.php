<?php

namespace drafteam\Controllers;


use drafteam\Models\UserModel;


session_start();

class DeleteSportifController
{
    public function deleteUser()
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
            UserModel::deleteUserById($idSportif);

            header('Location: /equipe');
            exit;
        }

        
        require_once('../src/Views/deleteSportif.php');
    }

    
}
<?php
/**
 * Auteur: Gabriel Martin
 * Date: 04.05.2023
 * Description: Page controller pour la page de suppression de sportifs
 * Version 1.0
 */
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
            UserModel::deleteUserById($_GET['idSportif']);

            header('Location: /monEquipe');
            exit;
        }

        
        require_once('../src/Views/deleteSportif.php');
    }

    
}
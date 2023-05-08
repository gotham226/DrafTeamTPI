<?php


namespace drafteam\Controllers;
use drafteam\Models\UserModel; 

session_start();

class AccueilController
{
    public function accueil()
    {
        
        if(isset($_SESSION['idEquipe']))
        {
            $equipe = UserModel::takeAllPeopleByIdEquipe($_SESSION['idEquipe']);
        }
        
        require_once('../src/Views/accueil.php');
    }
}
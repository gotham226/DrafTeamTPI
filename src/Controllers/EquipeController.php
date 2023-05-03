<?php

namespace drafteam\Controllers;

use drafteam\Models\EquipeModel;

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

        

        require_once('../src/Views/monEquipe.php');
    }

}
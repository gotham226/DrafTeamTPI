<?php

namespace drafteam\Controllers;
use drafteam\Models\UserModel;
use drafteam\Models\PosteModel;

session_start();

class ModifierSportifController
{
    public function modifierSportif()
    {
        if(!isset($_SESSION['email'])){

            header('Location: /');
            exit;
        }

        $error="";

        $sportif = UserModel::selectUserById($_GET['idSportif']);

        $postes = PosteModel::selectAllPoste();

        $idPoste = filter_input(INPUT_POST, 'poste', FILTER_SANITIZE_STRING);

        if(isset($_POST['modifierSportif']))
        {
            if($idPoste!="")
            {
                UserModel::UpdatePosteForAUser($_GET['idSportif'], $idPoste);
                header('Location: /monEquipe');
                exit;
            }
        }

        require_once('../src/Views/modifierSportif.php');
    }
}
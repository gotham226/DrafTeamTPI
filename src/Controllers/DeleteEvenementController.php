<?php

namespace drafteam\Controllers;


use drafteam\Models\EventModel;


session_start();

class DeleteEvenementController
{
    public function deleteEvenement()
    {
        if(!isset($_SESSION['entraineur'])){
            header('Location: /');
            exit;
        }

        if(isset($_POST['annuler']))
        {
            header('Location: /agenda');
            exit;
        }

        if(isset($_POST['oui']))
        {
            
            EventModel::deleteEvent($_GET['idEvenement']);
            header('Location: /');
            exit;
        }

        
        require_once('../src/Views/deleteEvenement.php');
    }

    
}
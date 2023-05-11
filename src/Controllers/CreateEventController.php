<?php
/**
 * Auteur: Gabriel Martin
 * Date: 08.05.2023
 * Description: Page controller pour la page de creation d'événements
 * Version 1.0
 */
namespace drafteam\Controllers;
use drafteam\Models\TypeModel;
use drafteam\Models\LieuModel;
use drafteam\Models\EventModel;

session_start();

class CreateEventController
{
    public function createEvent()
    {
        if(!isset($_SESSION['entraineur'])){

            header('Location: /');
            
        }

        $error = "";

        $types = TypeModel::selectAllType();
        $lieux = LieuModel::selectAllLocation();
        
        $nom = filter_input(INPUT_POST, 'nomEvent', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
        $lieu = filter_input(INPUT_POST, 'lieu', FILTER_SANITIZE_STRING);
        $debut = filter_input(INPUT_POST, 'debut', FILTER_SANITIZE_STRING);
        $fin = filter_input(INPUT_POST, 'fin', FILTER_SANITIZE_STRING);

        if(isset($_POST['creer']))
        {
            
            if($nom !="" && $description !="" && $type !="" && $lieu !="" && $debut !="" && $fin !="")
            {
                EventModel::createNewEvent($nom, $description, $type, $lieu, $debut, $fin);
                header("Location: /");
                exit;
            }
        }
        require_once('../src/Views/createEvent.php');
    }
}
<?php

namespace drafteam\Controllers;

use drafteam\Models\EventModel;
use drafteam\Models\UserModel;
use drafteam\Models\LieuModel;
use drafteam\Models\TypeModel;


session_start();

class EvenementController
{
    public function evenement()
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

        $uploads_dir = './assets/image';

        $error = "";

        $evenement = EventModel::selectEventById($_GET['idEvenement']);

        $monCoach = UserModel::takeTheCoach($_SESSION['idEquipe']);

        $joueursInviter = EventModel::selectGuestPlayer($_GET['idEvenement']);

        $monStaffInviter= EventModel::selectGuestStaff($_GET['idEvenement']);

        $duree = EvenementController::calculDuree($evenement['heureDebut'], $evenement['heureFin']);

        $adresse = LieuModel::selectLocationById($evenement['idLieu'])['adresse'];

        $type = TypeModel::selectTypeById($evenement['idType'])['type'];

        if(isset($_FILES['image']['name']) !="")
        {
            if($_FILES['image']['size']<= 3000000){
            
                $typeMedia = $_FILES['image']['type'];

                $extensionsFichier = substr(strrchr($_FILES['image']['name'],'.'),1);
                    

                if($typeMedia==""){
                    $typeMedia= "image/".$extensionsFichier;
                }

                    
                // Test si le fichier est bien une image
                if($typeMedia=="image/png" || $typeMedia=="image/jpeg" || $typeMedia=="image/jpg"){
                    $dateDuPost = date( "Y-m-d H:i:s");
                    $nom = $_FILES['image']['name'].$dateDuPost.".".$extensionsFichier;
                    $canUpload = true;
                }else{
                        $error = "Le fichier ".$_FILES['image']['name']." n'est pas une image";
                        $canUpload = false;
                    }
                    
                    $nom = str_replace(' ', '', $nom);
                if($canUpload == true)
                {
                        if(move_uploaded_file($_FILES['image']['tmp_name'], "$uploads_dir/$nom"))
                        {
                            EventModel::updateImageEvent($nom, $_GET['idEvenement']);
                        }
                }    
            }
        }
            

        


        



        
        require_once('../src/Views/evenement.php');
    }

    public function calculDuree($debut, $fin)
    {
        $timestamp1 = strtotime($debut);
        $timestamp2 = strtotime($fin);

        $difference = $timestamp2 - $timestamp1;

        $heures = floor($difference / 3600);
        $minutes = floor(($difference - ($heures * 3600)) / 60);

        return $heures. "H" . $minutes;

    }

}
<?php

/**
 * Auteur: Gabriel Martin
 * Date: 09.05.2023
 * Description: Page controller pour la page evenement
 * Version 1.0
 */

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


        if(EventModel::checkIfImInvited($_SESSION['idSportif'], $_GET['idEvenement']))
        {
            $invited = true;
            $infoParticipation = EventModel::checkIfImInvited($_SESSION['idSportif'], $_GET['idEvenement']);
        }
        else{
            $invited = false;
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

        $domicile = filter_input(INPUT_POST, 'domicile', FILTER_SANITIZE_NUMBER_INT);
        $exterieur = filter_input(INPUT_POST, 'exterieur', FILTER_SANITIZE_NUMBER_INT);

        if(isset($_POST['validerEnregistrer']))
        {
            if($domicile != '' && $exterieur !='')
            {
                $resultat = $domicile." - ". $exterieur;
                EventModel::setScore($_GET['idEvenement'], $resultat);
            }
            else{
                $error = "Tous les champs ne sont pas renseignés";
            }
        }

        if(isset($_POST['deleteImg']))
        {
            EventModel::deleteImgFromEvent($_GET['idEvenement']);
        }


        if(isset($_FILES['image']['name']) !="")
        {
            // Test que la taille ne dépasse pas le maximum autoriser par le serveur 
            if($_FILES['image']['size']<= 3000000){
            
                $typeMedia = $_FILES['image']['type'];

                $extensionsFichier = substr(strrchr($_FILES['image']['name'],'.'),1);
                    

                if($typeMedia==""){
                    $typeMedia= "image/".$extensionsFichier;
                }

                    
                // Test si le fichier est bien une image
                if($typeMedia=="image/png" || $typeMedia=="image/jpeg" || $typeMedia=="image/jpg"){
                    $dateDuPost = date( "Y-m-d H:i:s");
                    // Créer un nom de fichier unique
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

        if(isset($_POST['present']))
        {
            EventModel::metPresent($_SESSION['idSportif'], $_GET['idEvenement']);
            header('Location: /evenement?idEvenement='.$_GET['idEvenement']);
            exit;
        }

        $evenement = EventModel::selectEventById($_GET['idEvenement']);
        
            
        require_once('../src/Views/evenement.php');
    }

    // Fonction qi renvoie la durée en fonction d'une date de début et de fin 
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
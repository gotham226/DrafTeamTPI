<?php

namespace drafteam\Controllers;
use drafteam\Models\EventModel;
use drafteam\Models\UserModel;
use drafteam\Models\LieuModel;
use drafteam\Models\TypeModel;

session_start();

class ModifierEvenementController
{
    public function modifierEvenement()
    {
        if(!isset($_SESSION['entraineur'])){

            header('Location: /');
            exit;
        }

        if(isset($_SESSION['idEquipe']) == null){

            header('Location: /');
            exit;
        }

        $nomEvenement = filter_input(INPUT_POST, 'nomEvenement', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
        $lieu = filter_input(INPUT_POST, 'lieu', FILTER_SANITIZE_STRING);
        $debut = filter_input(INPUT_POST, 'debut', FILTER_SANITIZE_STRING);
        $fin = filter_input(INPUT_POST, 'fin', FILTER_SANITIZE_STRING);

        $evenement = EventModel::selectEventById($_GET['idEvenement']);

        $error="";
        $uploads_dir = './assets/image';
        $canUploadImage = false;

        $lieux = LieuModel::selectAllLocation();
        $types = TypeModel::selectAllType();

        if(isset($_POST['modifierEvenement']))
        {
            
            if($nomEvenement != "" && $description != "" && $type != "" && $lieu != "" && $debut != "" && $fin != "" )
            {
                
                if($_FILES['image']['name'] == '')
                {
                    if(EventModel::updateEventWithoutImage($nomEvenement, $description, $type, $lieu, $debut, $fin, $_GET['idEvenement']))
                    {
                        header("Location: /evenement?idEvenement=".$_GET['idEvenement']);
                        exit;
                    }

                }else{

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
                                    if($evenement['image'] !="" && $evenement['image'] != null)
                                    {
                                        unlink('./assets/image/'.$evenement['image']);
                                    }
                                    EventModel::updateEvent($nom, $description, $type, $lieu, $debut, $fin, $_GET['idEvenement'], $nom);
                                    header("Location: /evenement?idEvenement=".$_GET['idEvenement']);
                                    exit;
                                }
                        }    
                    }
                }
            }
        }
        


        require_once('../src/Views/modifierEvenement.php');
    }
}

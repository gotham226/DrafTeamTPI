<?php

namespace drafteam\Controllers;
use drafteam\Models\EquipeModel;
use drafteam\Models\UserModel;
use drafteam\Models\LieuModel;

session_start();

class CreationEquipeController
{
    public function creationEquipe()
    {
        if(!isset($_SESSION['entraineur'])){

            header('Location: /');
            exit;
        }

        if(isset($_SESSION['idEquipe']) != null){

            header('Location: /');
            exit;
        }

        $error="";
        $uploads_dir = './assets/image';
        $canUploadEcusson = false;

        $nomEquipe = filter_input(INPUT_POST, 'nomEquipe', FILTER_SANITIZE_STRING);
        $idLieu = filter_input(INPUT_POST, 'lieu', FILTER_SANITIZE_STRING);


        if(isset($_POST['creerEquipe']))
        {
            if($idLieu != "" && $nomEquipe != "")
            {
                if($_FILES['ecusson']['size']<= 3000000){
                    
                    $typeMediaEcusson = $_FILES['ecusson']['type'];

                    $extensionsFichierEcusson = substr(strrchr($_FILES['ecusson']['name'],'.'),1);
                    

                    if($typeMediaEcusson==""){
                        $typeMediaEcusson= "image/".$extensionsFichierEcusson;
                    }

                    
                    // Test si le fichier est bien une image
                    if($typeMediaEcusson=="image/png" || $typeMediaEcusson=="image/jpeg" || $typeMediaEcusson=="image/jpg"){
                        $dateDuPost = date( "Y-m-d H:i:s");
                        $nomEcusson = $_FILES['ecusson']['name'].$dateDuPost.".".$extensionsFichierEcusson;
                        $canUploadEcusson = true;
                    }else{
                            $error = "Le fichier ".$_FILES['ecusson']['name']." n'est pas une image";
                            $canUploadEcusson = false;
                        }
                    
                        $nomEcusson = str_replace(' ', '', $nomEcusson);
                    if($canUploadEcusson == true)
                    {
                            if(move_uploaded_file($_FILES['ecusson']['tmp_name'], "$uploads_dir/$nomEcusson"))
                            {
                                if(EquipeModel::createNewteam($nomEquipe, $nomEcusson, $_SESSION['idSportif'], $idLieu)){
                                
                                        
                                    header('Location: /monEquipe');
                                    exit;
                                }                                   
                            }
                    }    
                }
            }
            $error = "Tous les champs ne sont pas renseigné";

        
        }
        $lieus = LieuModel::selectAllLocation();


        
        

        require_once('../src/Views/creationEquipe.php');
    }
}

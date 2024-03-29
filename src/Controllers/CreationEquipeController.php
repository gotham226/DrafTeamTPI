<?php
/**
 * Auteur: Gabriel Martin
 * Date: 03.05.2023
 * Description: Page controller pour la page création d'équipe
 * Version 1.0
 */

namespace drafteam\Controllers;
use drafteam\Models\EquipeModel;
use drafteam\Models\UserModel;
use drafteam\Models\LieuModel;
use drafteam\Models\ChampionnatModel;

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
                // Test que la taille ne dépasse pas le maximum autoriser par le serveur 
                if($_FILES['ecusson']['size']<= 3000000){
                    
                    $typeMediaEcusson = $_FILES['ecusson']['type'];

                    $extensionsFichierEcusson = substr(strrchr($_FILES['ecusson']['name'],'.'),1);
                    

                    if($typeMediaEcusson==""){
                        $typeMediaEcusson= "image/".$extensionsFichierEcusson;
                    }

                    
                    // Test si le fichier est bien une image
                    if($typeMediaEcusson=="image/png" || $typeMediaEcusson=="image/jpeg" || $typeMediaEcusson=="image/jpg"){
                        $dateDuPost = date( "Y-m-d H:i:s");
                        // Créer un nom unique
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
                                
                                    $championnats = ChampionnatModel::selectAllChampionnatFromIdCoach($_SESSION['idSportif']);


                                    foreach($championnats as $championnat)
                                    {
                                        ChampionnatModel::participeChampionnat($championnat['idChampionnat'], $_SESSION['idEquipe']);
                                    }

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

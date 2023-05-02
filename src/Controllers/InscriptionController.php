<?php

namespace drafteam\Controllers;
use drafteam\Models\UserModel;

session_start();

class InscriptionController
{
    public function inscription()
    { 
        $uploads_dir = './assets/image';

        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $numTel = filter_input(INPUT_POST, 'numeroTel', FILTER_SANITIZE_NUMBER_INT);
        $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_STRING);
        $mdp1 = filter_input(INPUT_POST, 'mdp1', FILTER_SANITIZE_SPECIAL_CHARS);
        $mdp2 = filter_input(INPUT_POST, 'mdp2', FILTER_SANITIZE_SPECIAL_CHARS);

        $error="";



        if(isset($_POST['inscription'])){
                

                // Test si tout les champs sont renseigner
                if($nom != "" && $prenom != "" && $email != "" && $numTel != "" && $dateNaissance != "" && $mdp1 != "" && $mdp2 != "" ){
                    
                    var_dump(UserModel::checkIfEmailExist($email));
                    // Test si l'email est déjà utilisé
                    if(UserModel::checkIfEmailExist($email) != ""){

                        if($_FILES['baniere']['size']<= 3000000 && $_FILES['profil']['size'] <= 3000000  ){
                    
                            $typeMediaProfil = $_FILES['profil']['type'];
                            $typeMediaBaniere = $_FILES['baniere']['type'];
        
                            $extensionsFichierProfil = substr(strrchr($_FILES['profil']['name'],'.'),1);
                            $extensionsFichierBaniere = substr(strrchr($_FILES['baniere']['name'],'.'),1);
                            
        
                            if($typeMediaProfil==""){
                                $typeMediaProfil= "image/".$extensionsFichierProfil;
                            }
        
                            if($typeMediaBaniere==""){
                                $typeMediaBaniere= "image/".$extensionsFichierBaniere;
                            }
        
                            
                            // Test si le fichier est bien une image
                            if($typeMediaProfil=="image/png" || $typeMediaProfil=="image/jpeg" || $typeMediaProfil=="image/jpg"){
                                $dateDuPost = date( "Y-m-d H:i:s");
                                $nomImageProfil = $_FILES['profil']['name'].$dateDuPost.".".$extensionsFichierProfil;
                                $canUploadProfil = true;
                            }else{
                                    $error = "Le fichier ".$_FILES['profil']['name']." n'est pas une image";
                                    $canUploadBaniere = false;
                                }
        
                            // Test si le fichier est bien une image
                            if($typeMediaBaniere=="image/png" || $typeMediaBaniere=="image/jpeg" || $typeMediaBaniere=="image/jpg"){
                                $dateDuPost = date( "Y-m-d H:i:s");
                                $nomImageBaniere = $_FILES['baniere']['name'].$dateDuPost.".".$extensionsFichierBaniere;
                                $canUploadBaniere = true;
                            }else{
                                $error = "Le fichier ".$_FILES['baniere']['name']." n'est pas une image";
                                $canUploadBaniere = false;
                            }
                        }

                        if($mdp1 == $mdp2){
                    
                            $options = [
                                'cost' => 10,
                            ];
                            //* hash le mot de passe en BCRYPT 
                            $hashPassword = password_hash($mdp1, PASSWORD_BCRYPT, $options);

                            if($canUploadProfil == true && $canUploadBaniere == true){
                                if(move_uploaded_file($_FILES['profil']['tmp_name'], "$uploads_dir/$nomImageProfil") && move_uploaded_file($_FILES['baniere']['tmp_name'], "$uploads_dir/$nomImageBaniere"))
                                {
                                    if(UserModel::registerUser($nom, $prenom, $email, $hashPassword, $numTel, $dateNaissance, $nomImageProfil, $nomImageBaniere, 1)){
                                
                                        
                                        $_SESSION['email'] = $email;
                                        $_SESSION['entraineur'] = true;
                                        $_SESSION['photoProfil'] = $nomImageProfil;
                                        $_SESSION['photoBaniere'] = $nomImageBaniere;
                                        $_SESSION['idSportif'] = UserModel::takeIdByEmail($email)['idSportif'];
                                        header('Location: /');
                                        exit;
                                    }                                   
                                }
                            }

                        }else{
                            $error = "Les deux mot de passe ne sont pas semblable";
                        }
                    }else{
                        $error = "Cet email est déjà utilisée";
                    }
                }else{
                    $error = "Tout les champs ne sont pas renseigné";
                }

                
        }

        require_once('../src/Views/inscription.php');
    }
}
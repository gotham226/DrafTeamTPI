<?php
/**
 * Auteur: Gabriel Martin
 * Date: 09.05.2023
 * Description: Page controller pour la page de modification de profil
 * Version 1.0
 */
namespace drafteam\Controllers;
use drafteam\Models\UserModel;
use drafteam\Models\PosteModel;

session_start();

class ModifierProfilController
{
    public function modifierProfil()
    {
        if(!isset($_SESSION['email'])){

            header('Location: /');
            
        }

        $error="";

        $errorMdp="";
        $messageMdp = "";


        $sportif = UserModel::selectUserById($_GET['idSportif']);

        $poste = PosteModel::selectPosteById($sportif['idPoste'])['poste'];



        $uploads_dir = './assets/image';
        $canUploadPhoto = false;
        $canUploadBaniere = false;

        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $numTel = filter_input(INPUT_POST, 'numeroTel', FILTER_SANITIZE_NUMBER_INT);
        $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_STRING);
        $mdp1 = filter_input(INPUT_POST, 'ancienMdp', FILTER_SANITIZE_SPECIAL_CHARS);
        $mdp2 = filter_input(INPUT_POST, 'nouveauMdp', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(isset($_POST['modifierMdp']))
        {
            if($mdp1 !="" && $mdp2 !="")
            {
                $result = UserModel::connexionCheck($_SESSION['email']);
                
                if(password_verify($mdp1,$result['motDePasse']))
                {
                    $options = [
                        'cost' => 10,
                    ];
                    // Hash le mot de passe en BCRYPT 
                    $hashPassword = password_hash($mdp2, PASSWORD_BCRYPT, $options);

                    UserModel::UpdateMdpForAUser($_GET['idSportif'], $hashPassword);
                    $messageMdp="Le mot de passe a bien été modifié.";
                }else{
                    $errorMdp = "Le mot de passe actuel n'est pas le bon";
                }
            }else{
                $errorMdp = "Tous les champs ne sont pas renseignés";
            }
        }


        if(isset($_POST['modifierProfil']))
        {
            if($email !="")
            {
                if($_FILES['profil']['name'] == "")
                {
                    
                    $nomprofil = $sportif['photo'];
                    $canUploadProfil = true;
                }else{
                    // Test que la taille ne dépasse pas le maximum autoriser par le serveur 
                    if($_FILES['profil']['size']<= 3000000){
                        
                        $typeMediaprofil = $_FILES['profil']['type'];

                        $extensionsFichierprofil = substr(strrchr($_FILES['profil']['name'],'.'),1);
                        

                        if($typeMediaprofil==""){
                            $typeMediaprofil= "image/".$extensionsFichierprofil;
                        }

                        
                        // Test si le fichier est bien une image
                        if($typeMediaprofil=="image/png" || $typeMediaprofil=="image/jpeg" || $typeMediaprofil=="image/jpg"){
                            $dateDuPost = date( "Y-m-d H:i:s");
                            // Créer un nom de fichier unique
                            $nomprofil = $_FILES['profil']['name'].$dateDuPost.".".$extensionsFichierprofil;
                            $canUploadProfil = true;
                            $nomprofil = str_replace(' ', '', $nomprofil);
                        }else{
                                $error = "Le fichier ".$_FILES['profil']['name']." n'est pas une image";
                                $canUploadProfil = false;
                            }
                        
                    }
                }

                if($_FILES['baniere']['name'] == "")
                {
                    $nomBaniere = $sportif['baniere'];
                    $canUploadBaniere = true;
                }else{
                    // Test que la taille ne dépasse pas le maximum autoriser par le serveur 
                    if($_FILES['baniere']['size']<= 3000000){
                        
                        $typeMediaBaniere = $_FILES['baniere']['type'];

                        $extensionsFichierBaniere = substr(strrchr($_FILES['baniere']['name'],'.'),1);
                        

                        if($typeMediaBaniere==""){
                            $typeMediaBaniere= "image/".$extensionsFichierBaniere;
                        }

                        
                        // Test si le fichier est bien une image
                        if($typeMediaBaniere=="image/png" || $typeMediaBaniere=="image/jpeg" || $typeMediaBaniere=="image/jpg"){
                            $dateDuPost = date( "Y-m-d H:i:s");
                            // Créer un nom de fichier unique
                            $nomBaniere = $_FILES['baniere']['name'].$dateDuPost.".".$extensionsFichierBaniere;
                            $canUploadBaniere = true;
                            $nomBaniere = str_replace(' ', '', $nomBaniere);
                        }else{
                                $error = "Le fichier ".$_FILES['baniere']['name']." n'est pas une image";
                                $canUploadBaniere = false;
                            }
                        
                    }
                }

                
                    

                    if($canUploadProfil == true && $canUploadBaniere == true)
                    {

                        // Si la photo de profil n'a pas changer 
                        if($nomprofil != $sportif['photo'])
                        {
                            if(move_uploaded_file($_FILES['profil']['tmp_name'], "$uploads_dir/$nomprofil"))
                            {
                                if($sportif['photo'] != null && $sportif['photo'] !="")
                                {
                                    unlink('./assets/image/'.$sportif['photo']);
                                }
                            }
                        }
                        // Si la baniere n'a pas changer 
                        if($nomBaniere != $sportif['baniere'])
                        {
                            if(move_uploaded_file($_FILES['baniere']['tmp_name'], "$uploads_dir/$nomBaniere"))
                            {
                                if($sportif['baniere'] != null && $sportif['baniere'] !="")
                                {
                                    unlink('./assets/image/'.$sportif['baniere']);
                                }
                            }
                        }
                        if($dateNaissance=="")
                        {
                            $dateNaissance = null;
                        }

                        if(UserModel::updateUser($_SESSION['idSportif'], $nom, $prenom, $dateNaissance, $numTel, $email, $nomprofil, $nomBaniere)){
                            // Met à jour les informations du sportif
                            $_SESSION['email'] = $email;
                            $_SESSION['photoProfil'] = $nomprofil;
                            $_SESSION['photoBaniere'] = $nomBaniere;
                            $_SESSION['idSportif'] = UserModel::takeUserByEmail($email)['idSportif'];
                            $_SESSION['idEquipe'] = UserModel::takeUserByEmail($email)['idEquipe'];
                                header('Location: /');
                            exit;
                        }                                   
                    }
                }    
                else{
                
                $error = "L'email est un champ obligatoire";
            }
        }

        require_once('../src/Views/modifierProfil.php');
    }


}

        

<?php

namespace drafteam\Controllers;
use drafteam\Models\UserModel;

session_start();

class ConnexionController
{
    public function connexion()
    { 
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_SPECIAL_CHARS);

        $error="";

        if(isset($_POST['connexion']))
        {
            if($email != "" && $mdp != "")
            {
                $result = UserModel::connexionCheck($email);

                if($result)
                {
                    if(password_verify($mdp,$result['motDePasse']))
                    {
                        $user = UserModel::takeUserByEmail($email);

                        if($user['idPoste'] == 1)
                        {
                            $_SESSION['entraineur'] = true;
                            
                            $_SESSION['idSportif'] = UserModel::takeUserByEmail($email)['idSportif'];
                            
                        }else{
                            if($user['idPoste'] == 2)
                            {
                                $_SESSION['staff'] = true;
                            }
                        }

                        $_SESSION['email'] = $email;
                        $_SESSION['photoProfil'] = $user['photo'];
                        $_SESSION['photoBaniere'] = $user['baniere'];
                        $_SESSION['idPoste'] = $user['idPoste'];
                        $_SESSION['idEquipe'] = UserModel::takeUserByEmail($email)['idEquipe'];

                        header('Location: /');
                            exit;



                    }else{
                        $error = "Le mot de passe et/ou l'email ne sont pas bons";
                    }
                    
                }else{
                    $error = "Le mot de passe et/ou l'email ne sont pas bons";
                }
            }else{
                $error = "Tous les champs ne sont pas rensigné";
            }
        }

        require_once('../src/Views/connexion.php');
    }
}
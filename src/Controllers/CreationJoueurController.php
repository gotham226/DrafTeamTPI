<?php
/**
 * Auteur: Gabriel Martin
 * Date: 04.05.2023
 * Description: Page controller pour la page création de joueurs
 * Version 1.0
 */
namespace drafteam\Controllers;
use drafteam\Models\EquipeModel;
use drafteam\Models\UserModel;
use drafteam\Models\PosteModel;

session_start();

class CreationJoueurController
{
    public function creationJoueur()
    {
        if(!isset($_SESSION['entraineur'])){

            header('Location: /');
            exit;
        }

        $postes = PosteModel::selectAllPoste();

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_SPECIAL_CHARS);
        $idPoste = filter_input(INPUT_POST, 'poste');


        $mdpGenerer = CreationJoueurController::generatePassword();
        $error="";

        if(isset($_POST['inscription']))
        {
            if($email!="" && $mdp!="" && $idPoste!="")
            {
                if(UserModel::checkIfEmailExist($email) == null)
                {
                    $options = [
                        'cost' => 10,
                    ];
                    //* hash le mot de passe en BCRYPT 
                    $hashPassword = password_hash($mdp, PASSWORD_BCRYPT, $options);

                    if(UserModel::registerUser("", "", $email, $hashPassword, null, null, null, null, $idPoste, $_SESSION['idEquipe']))
                    {
                        header('Location: /monEquipe');
                        exit;
                    }

                }else{
                    $error = "L'email est déjà utiliser.";
                }
            }
            else{
                $error = "Tous les champs ne sont pas renseigner.";
            }
        }

        

        require_once('../src/Views/creationJoueur.php');
    }

    public function generatePassword() {
        $length = 8;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $password;
    }
}
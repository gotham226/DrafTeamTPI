<?php
/**
 * Auteur: Gabriel Martin
 * Date: 10.05.2023
 * Description: Page controller pour la page d'invitation au événements
 * Version 1.0
 */
namespace drafteam\Controllers;
use drafteam\Models\UserModel;
use drafteam\Models\EventModel;

session_start();

class InvitationEvenementController
{
    public function invitationEvenement()
    {
        if(!isset($_SESSION['entraineur'])){
            header('Location: /');
            exit;
        }

        if(!isset($_GET['idEvenement']) && !isset($_GET['poste']))
        {
            header('Location: /');
            exit;
        }
        if($_GET['poste'] == 'joueur')
        {
            $mesJoueurs = UserModel::selectAllUninvitedPlayers($_GET['idEvenement'], $_SESSION['idEquipe']);
            $poste="Joueur";
        }else{
            $mesJoueurs = UserModel::selectAllUninvitedStaff($_GET['idEvenement'], $_SESSION['idEquipe']);
            $poste="Staff";
        }

        

        if(isset($_POST['inviter']))
        {
            foreach ($mesJoueurs as $joueur)
            {
                $idSportif = $joueur['idSportif'];

                if(isset($_POST['invitation'.$idSportif]))
                {
                    EventModel::inviteAPlayerToEvent($idSportif, $_GET['idEvenement']);
                }
            }

            header('Location: /evenement?idEvenement='.$_GET['idEvenement']);
            exit;
            
        }


        

        require_once('../src/Views/invitationEvenement.php');
    }
}
<?php
/**
 * Auteur: Gabriel Martin
 * Date: 02.05.2023
 * Description: Page controller pour la page accueil
 * Version 1.0
 */

namespace drafteam\Controllers;
use drafteam\Models\UserModel; 
use drafteam\Models\EventModel; 

session_start();

class AccueilController
{
    public function accueil()
    {
        
        if(isset($_SESSION['idEquipe']))
        {
            $equipe = UserModel::takeAllPeopleByIdEquipe($_SESSION['idEquipe']);
            $evenements = EventModel::selectNextFiveEvent($_SESSION['idEquipe']);
        }

        require_once('../src/Views/accueil.php');
    }

    // Fonction qui renvoie un format de date sous la forme :  Mardi 12 mai 2023 à 20:30
    public function formatDate($date) {
        $jourSemaine = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
        $mois = array('', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    
        $timestamp = strtotime($date);
        $jour = $jourSemaine[date('w', $timestamp)];
        $numJour = date('j', $timestamp);
        $moisNum = date('n', $timestamp);
        $nomMois = $mois[$moisNum];
        $annee = date('Y', $timestamp);
        $heure = date('G', $timestamp);
        $minute = date('i', $timestamp);
    
        return "$jour $numJour $nomMois $annee à $heure:$minute";
    }
}
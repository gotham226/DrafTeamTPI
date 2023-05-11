<?php

/**
 * Auteur: Gabriel Martin
 * Date: 08.05.2023
 * Description: Page controller pour la page Agenda
 * Version 1.0
 */

namespace drafteam\Controllers;

use drafteam\Models\AgendaModel;

session_start();

class AgendaController
{
    public function agenda()
    {
        if(!isset($_SESSION['email'])){
            header('Location: /');
        }
        require_once('../src/Views/agenda.php');
    }

    //Récupère tous les événements de l'équipe actuelle et les formate pour la vue de l'agenda.
    public function agendaEvent()
    {
        // Récupération de tous les événements de l'équipe actuelle dans la base de données.
        $result = AgendaModel::selectAllEventByIdEquipe($_SESSION['idEquipe']);

        $data = array();
        // Pour chaque événement, on formatte les informations nécessaires pour l'affichage.
        foreach ($result as $row) {
            $color = "";

            // Définition de la couleur de l'événement en fonction de son type.
            switch ($row['idType']) {
                case 1:
                    $color = "purple";
                    break;
                case 2:
                    $color = "red";
                    break;
                case 3:
                    $color = "blue";
                    break;
            }

            $data[] = array(
                'title' => $row['nomEvenement'],
                'start' => $row['heureDebut'],
                'end' => $row['heureFin'],
                'color' => $color,
                'publicId' => $row['idEvenement']
            );
        }
        
        // Encodage des données au format JSON pour l'affichage dans la vue.
        echo json_encode($data);
    }
}
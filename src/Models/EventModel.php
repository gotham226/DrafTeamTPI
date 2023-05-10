<?php
/**
 * Auteur: Gabriel Martin
 * Date: 08.05.2023
 * Description: Page contenant toute les requêtes concernant les événements
 * Version 1.0
 */

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class EventModel
{   
    // Créer un nouvel événements
    public static function createNewEvent($nom, $description, $type, $lieu, $debut, $fin)
    {

        $dateEvenement = substr($fin, 0, 10);

        $sql = "INSERT INTO evenement(nomEvenement, description, dateEvenement, heureDebut, heureFin, idType, idLieu, idSportif, idEquipe) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        
        $data = [            
            $nom,             
            $description,            
            $dateEvenement,            
            $debut,
            $fin,
            $type,
            $lieu,
            $_SESSION['idSportif'],
            $_SESSION['idEquipe']
        ];

        return database::dbRun($sql, $data);
    }

    // Sélectionne un événements en fonction de son id 
    public static function selectEventById($idEvent){
        $sql = "SELECT * FROM evenement WHERE idEvenement = ?";
        $data = [
            $idEvent
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    // Séléctione tout les joueurs inviter à un événement 
    public static function selectGuestPlayer($idEvent)
    {
        $sql = "SELECT sportif.*
        FROM sportif
        INNER JOIN etre_present ON sportif.idSportif = etre_present.idSportif
        LEFT JOIN poste ON sportif.idPoste = poste.idPoste
        WHERE poste.staff = 0 AND poste.admin = 0 AND etre_present.idEvenement = ?";

        $data = [
            $idEvent
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);

    }

    // Séléctione tout les staffs inviter à un événement
    public static function selectGuestStaff($idEvent)
    {
        $sql = "SELECT sportif.*
        FROM sportif
        INNER JOIN etre_present ON sportif.idSportif = etre_present.idSportif
        LEFT JOIN poste ON sportif.idPoste = poste.idPoste
        WHERE poste.staff = 1 AND poste.admin = 0 AND etre_present.idEvenement = ?";

        $data = [
            $idEvent
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Supprime un événement et les liaison dans la table etre_present et l'image liée à l'événement si il y en a une
    public static function deleteEvent($idEvent)
    {
        if(EventModel::selectEventById($idEvent)['image'] != "" && EventModel::selectEventById($idEvent)['image'] != null)
        {
            unlink('./assets/image/'.EventModel::selectEventById($idEvent)['image']);
        }   
        

        $sql = "DELETE FROM etre_present
        WHERE idEvenement = ?";

        $data = [
            $idEvent
        ];
        database::dbRun($sql, $data);


        $sql = "DELETE FROM evenement
        WHERE idEvenement = ?";

        $data = [
            $idEvent
        ];
        database::dbRun($sql, $data);

    }

    // Modifie l'image de l'événement
    public static function updateImageEvent($nomImage, $idEvenement)
    {
        $sql = "UPDATE evenement SET image = ? WHERE idEvenement = ?";

        $data=[
            $nomImage,
            $idEvenement
        ];
        
        return database::dbRun($sql, $data);
    }

    // Modifie un événement sans modifier l'image
    public static function updateEventWithoutImage($nom, $description, $type, $lieu, $debut, $fin, $idEvenement)
    {
        $sql = "UPDATE evenement SET nomEvenement = ?, description = ?, idType = ?, idLieu = ?, heureDebut = ?, heureFin = ?  WHERE idEvenement = ?";

        $data=[
            $nom,
            $description,
            $type,
            $lieu,
            $debut,
            $fin, 
            $idEvenement
        ];
        
        return database::dbRun($sql, $data);
    }

    // Modifie un événement en modifiant l'image
    public static function updateEvent($nom, $description, $type, $lieu, $debut, $fin, $idEvenement, $image)
    {
        $sql = "UPDATE evenement SET nomEvenement = ?, description = ?, idType = ?, idLieu = ?, heureDebut = ?, heureFin = ?, image = ?  WHERE idEvenement = ?";

        $data=[
            $nom,
            $description,
            $type,
            $lieu,
            $debut,
            $fin, 
            $image,
            $idEvenement
        ];
        
        return database::dbRun($sql, $data);
    }

    // Sélectionne les 5 prochains événements
    public static function selectNextFiveEvent(){
        $sql = "SELECT *
        FROM evenement
        WHERE heureDebut >= NOW()
        ORDER BY heureDebut ASC
        LIMIT 5;";
        $data = [
            
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajoute un sportif dans la table etre_present avec l'id de l'événement ou il est inviter
    public static function inviteAPlayerToEvent($idSportif, $idEvenement)
    {

        $sql = "INSERT INTO etre_present(idSportif, idEvenement) VALUES (?, ?);";
        
        $data = [            
            $idSportif,             
            $idEvenement
        ];

        return database::dbRun($sql, $data);
    }

    // Met un sportif présent a un événements 
    public static function metPresent($idSportif, $idEvenement)
    {

        $sql = "UPDATE etre_present SET present = ?, commentaire = ? WHERE idSportif = ? AND idEvenement = ?;";
        
        $data = [         
            1,   
            "",
            $idSportif,             
            $idEvenement
        ];

        return database::dbRun($sql, $data);
    }

    // Check si un sportif est inviter a un événement
    public static function checkIfImInvited($idSportif, $idEvenement)
    {

        $sql = "SELECT * FROM etre_present WHERE idEvenement = ? AND idSportif = ?";
        $data = [
            $idEvenement,
            $idSportif
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    // Met un sportif absent avec un commentaire dans la table etre_present
    public static function metAbsentAvecRaison($idSportif, $idEvenement, $raison)
    {

        $sql = "UPDATE etre_present SET present = ?, commentaire = ? WHERE idSportif = ? AND idEvenement = ?;";
        
        $data = [         
            0,   
            $raison,
            $idSportif,             
            $idEvenement
        ];

        return database::dbRun($sql, $data);
    }

    






}
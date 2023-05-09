<?php

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class EventModel
{
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

    public static function selectEventById($idEvent){
        $sql = "SELECT * FROM evenement WHERE idEvenement = ?";
        $data = [
            $idEvent
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

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

    public static function updateImageEvent($nomImage, $idEvenement)
    {
        $sql = "UPDATE evenement SET image = ? WHERE idEvenement = ?";

        $data=[
            $nomImage,
            $idEvenement
        ];
        
        return database::dbRun($sql, $data);
    }

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



}
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
}
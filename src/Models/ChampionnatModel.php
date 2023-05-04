<?php

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class ChampionnatModel
{
    public static function participeChampionnat($idChampionnat, $idEquipe)
    {
        $sql = "INSERT INTO participe(idChampionnat, idEquipe, actif) VALUES (?, ?, ?);";
        
        $data = [            
            $idChampionnat,
            $idEquipe,
            0
        ];

        return database::dbRun($sql, $data);
    }


    public static function creerNouveauChampionnat($nomChampionnat, $saison, $idSportif)
    {
        $sql = "INSERT INTO championnat(nomChampionnat, saison, idSportif) VALUES (?, ?, ?);";
        
        $data = [            
            $nomChampionnat,
            $saison,
            $idSportif,
        ];

        
        
        database::dbRun($sql, $data);

        $idChampionnat = database::Db()->lastInsertId();

        ChampionnatModel::participeChampionnat($idChampionnat, $_SESSION['idEquipe']);
    }

    public static function setAllChampionnatInnactiv()
    {
        $sql = "UPDATE championnat SET actif = ? WHERE actif = ?";

        $data=[
            0,
            1
        ];
        
        return database::dbRun($sql, $data);
    }
    
    public static function selectAllChampionnatFromIdCoach($idCoach)
    {
        $sql = "SELECT * FROM championnat WHERE idSportif = ?";
        $data = [
            $idCoach
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function deleteChampionnatById($idChampionnat){
        $sql = "DELETE FROM championnat WHERE idChampionnat = ?";
        $data = [
            $idChampionnat,
        ];
    
        database::dbRun($sql, $data); 
    }

    public static function selectChampionnatByID($idChampionnat)
    {
        $sql = "SELECT * FROM championnat WHERE idChampionnat = ?";
        $data = [
            $idChampionnat
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    public static function UpdateChampionnatById($nomChampionnat, $idChampionnat)
    {
        $sql = "UPDATE championnat SET nomChampionnat = ? WHERE idChampionnat = ?";

        $data=[
            $nomChampionnat,
            $idChampionnat
        ];
        
        return database::dbRun($sql, $data);
    }

    public static function mettreChampionnatActif($idChampionnat, $idEquipe)
    {
        $sql = "UPDATE participe SET actif = ? WHERE idChampionnat = ? AND idEquipe = ?";

        $data=[
            1,
            $idChampionnat,
            $idEquipe
        ];
        
        database::dbRun($sql, $data);
    }

    public static function desactiverChampionnat($idChampionnat, $idEquipe)
    {
        $sql = "UPDATE participe SET actif = ? WHERE actif = ? AND idEquipe = ?";

        $data=[
            0,
            1,
            $idEquipe
        ];

        
        
        database::dbRun($sql, $data);

        ChampionnatModel::mettreChampionnatActif($idChampionnat, $idEquipe);

    }

    public static function isActive()
    {
        $sql = "SELECT idChampionnat FROM participe WHERE actif = ?";
        $data = [1];
        $result = database::dbRun($sql, $data)->fetchColumn();
        return $result !== false ? $result : null;
    }

    

    
    

    

}
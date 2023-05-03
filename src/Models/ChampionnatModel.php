<?php

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class ChampionnatModel
{
    public static function creerNouveauChampionnat($nomChampionnat, $saison, $idSportif, $actif)
    {
        $sql = "INSERT INTO championnat(nomChampionnat, saison, idSportif, actif) VALUES (?, ?, ?, ?);";
        
        $data = [            
            $nomChampionnat,
            $saison,
            $idSportif,
            $actif
        ];

        return database::dbRun($sql, $data);
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

}
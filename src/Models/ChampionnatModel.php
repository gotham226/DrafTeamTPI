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
    
}
<?php

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class PosteModel
{
    public static function selectAllPoste()
    {
        $sql = "SELECT * FROM poste WHERE poste != ?";
        $data = [
            'Entraîneur'
        ];
        
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function selectPosteById($idPoste)
    {
        $sql = "SELECT poste FROM poste WHERE idPoste = ?";
        $data = [
            $idPoste
        ];
        
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }
}
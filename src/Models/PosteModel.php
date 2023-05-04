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
}
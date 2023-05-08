<?php

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class TypeModel
{
    public static function selectAllType()
    {
        $sql = "SELECT * FROM type_evenement";
        $data = [
        ];
        
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }
}
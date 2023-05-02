<?php

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class AgendaModel
{
    public static function selectAllEvent()
    {
        $sql = "SELECT * FROM evenement";

        return database::dbRun($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    
}


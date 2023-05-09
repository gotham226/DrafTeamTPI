<?php

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class LieuModel
{
    public static function selectAllLocation()
    {
        $sql = "SELECT * FROM lieu";
        $data = [
            
        ];
        
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function selectLocationById($idLieu)
    {
        $sql = "SELECT * FROM lieu WHERE idLieu = ?";
        $data = [
            $idLieu
        ];
        
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    
}
<?php
/**
 * Auteur: Gabriel Martin
 * Date: 04.05.2023
 * Description: Page contenant toutes les requêtes concernant les lieux
 * Version 1.0
 */

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class LieuModel
{
    // Sélectionne tous les lieux
    public static function selectAllLocation()
    {
        $sql = "SELECT * FROM lieu";
        $data = [
            
        ];
        
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Sélectionne un lieu en fonction de son id
    public static function selectLocationById($idLieu)
    {
        $sql = "SELECT * FROM lieu WHERE idLieu = ?";
        $data = [
            $idLieu
        ];
        
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    
}
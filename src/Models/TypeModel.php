<?php
/**
 * Auteur: Gabriel Martin
 * Date: 09.05.2023
 * Description: Page contenant toute les requêtes concernant les types d'événements
 * Version 1.0
 */

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class TypeModel
{
    // Sélectionne tout les type d'événements
    public static function selectAllType()
    {
        $sql = "SELECT * FROM type_evenement";
        $data = [
        ];
        
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Sélectionne un type en fonction de son id 
    public static function selectTypeById($idType)
    {
        $sql = "SELECT * FROM type_evenement WHERE idType = ?";
        $data = [
            $idType
        ];
        
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }
}
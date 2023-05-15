<?php
/**
 * Auteur: Gabriel Martin
 * Date: 04.05.2023
 * Description: Page contenant toutes les requêtes concernant les postes
 * Version 1.0
 */

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class PosteModel
{
    // Sélectionne tout les postes
    public static function selectAllPoste()
    {
        $sql = "SELECT * FROM poste WHERE poste != ?";
        $data = [
            'Entraîneur'
        ];
        
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Sélectionne un poste en fonction de son id 
    public static function selectPosteById($idPoste)
    {
        $sql = "SELECT poste FROM poste WHERE idPoste = ?";
        $data = [
            $idPoste
        ];
        
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }
}
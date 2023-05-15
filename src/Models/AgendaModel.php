<?php
/**
 * Auteur: Gabriel Martin
 * Date: 08.05.2023
 * Description: Page contenant toutes les requêtes concernant l'agenda
 * Version 1.0
 */

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class AgendaModel
{
    /**
     * Sélectionne tous les événements.
     * @return array Tableau associatif contenant les informations de tous les événements.
     */
    public static function selectAllEventByIdEquipe($idEquipe)
    {
        $sql = "SELECT * FROM evenement WHERE idEquipe = ?";
        $data = [
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }
    
}


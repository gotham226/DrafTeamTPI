<?php
/**
 * Auteur: Gabriel Martin
 * Date: 04.05.2023
 * Description: Page contenant toute les requêtes concernant les championnats
 * Version 1.0
 */

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class ChampionnatModel
{
    // Sélectionne tous les événements de la base de données
    public static function selectAllEvent()
    {
        $sql = "SELECT * FROM evenement";

        return database::dbRun($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajoute une équipe à un championnat
    public static function participeChampionnat($idChampionnat, $idEquipe)
    {
        $sql = "INSERT INTO participe(idChampionnat, idEquipe, actif) VALUES (?, ?, ?);";
        
        $data = [            
            $idChampionnat,
            $idEquipe,
            0 // actif est mis à 0 par défaut
        ];

        return database::dbRun($sql, $data);
    }

    // Crée un nouveau championnat
    public static function creerNouveauChampionnat($nomChampionnat, $saison, $idSportif)
    {
        $sql = "INSERT INTO championnat(nomChampionnat, saison, idSportif) VALUES (?, ?, ?);";
        
        $data = [            
            $nomChampionnat,
            $saison,
            $idSportif,
        ];

        // Insertion du nouveau championnat dans la base de données
        database::dbRun($sql, $data);

        // Obtient l'id du nouveau championnat
        $idChampionnat = database::Db()->lastInsertId();

        // Vérifie si la personne connectée a une équipe
        if(isset($_SESSION['idEquipe']))
        {
            // Ajoute l'équipe au championnat
            ChampionnatModel::participeChampionnat($idChampionnat, $_SESSION['idEquipe']);
        }   
    }

    // Met tous les championnats inactifs
    public static function setAllChampionnatInnactiv()
    {
        $sql = "UPDATE championnat SET actif = ? WHERE actif = ?";

        $data=[
            0,
            1
        ];
        
        return database::dbRun($sql, $data);
    }

    // Sélectionne tous les championnats d'un coach donné
    public static function selectAllChampionnatFromIdCoach($idCoach)
    {
        $sql = "SELECT * FROM championnat WHERE idSportif = ?";
        $data = [
            $idCoach
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Supprime un championnat par ID
    public static function deleteChampionnatById($idChampionnat){
        $sql = "DELETE FROM championnat WHERE idChampionnat = ?";
        $data = [
            $idChampionnat,
        ];

        // Supprime le championnat de la base de données
        database::dbRun($sql, $data); 
    }

    // Sélectionne un championnat par ID
    public static function selectChampionnatByID($idChampionnat)
    {
        $sql = "SELECT * FROM championnat WHERE idChampionnat = ?";
        $data = [
            $idChampionnat
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    // Modifie le nom d'un championnat par ID
    public static function UpdateChampionnatById($nomChampionnat, $idChampionnat)
    {
        $sql = "UPDATE championnat SET nomChampionnat = ? WHERE idChampionnat = ?";

        $data=[
            $nomChampionnat,
            $idChampionnat
        ];
        
        return database::dbRun($sql, $data);
    }

   /**
     * Met à jour le champ "actif" à 1 pour l'équipe donnée dans le championnat donné
     * 
     * @param int $idChampionnat Identifiant du championnat
     * @param int $idEquipe Identifiant de l'équipe
     * @return void
     */
    public static function mettreChampionnatActif($idChampionnat, $idEquipe)
    {
        $sql = "UPDATE participe SET actif = ? WHERE idChampionnat = ? AND idEquipe = ?";

        $data=[
            1,
            $idChampionnat,
            $idEquipe
        ];
        
        database::dbRun($sql, $data);
    }

    /**
     * Désactive le championnat pour l'équipe donnée et active un autre championnat si possible
     * 
     * @param int $idChampionnat Identifiant du championnat à désactiver
     * @param int $idEquipe Identifiant de l'équipe
     * @return void
     */
    public static function desactiverChampionnat($idChampionnat, $idEquipe)
    {
        $sql = "UPDATE participe SET actif = ? WHERE actif = ? AND idEquipe = ?";

        $data=[
            0,
            1,
            $idEquipe
        ];

        
        
        database::dbRun($sql, $data);

        ChampionnatModel::mettreChampionnatActif($idChampionnat, $idEquipe);

    }

    /**
     * Récupère l'identifiant du championnat actif, s'il y en a un
     * 
     * @return int|null L'identifiant du championnat actif, ou null s'il n'y en a pas
     */
    public static function isActive()
    {
        $sql = "SELECT idChampionnat FROM participe WHERE actif = ?";
        $data = [1];
        $result = database::dbRun($sql, $data)->fetchColumn();
        return $result !== false ? $result : null;
    }
    

    
    

    

}
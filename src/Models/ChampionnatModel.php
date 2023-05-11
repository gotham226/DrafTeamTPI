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
    /**

     *Ajoute une équipe à un championnat en tant que participant
     *
     *@param int $idChampionnat ID du championnat auquel l'équipe participe
     *@param int $idEquipe ID de l'équipe qui participe au championnat
     *@param int $actif (optionnel) statut de participation de l'équipe, par défaut est 0 (inactif)
     *@return bool Renvoie true si l'insertion a réussi, sinon false.
    */
    public static function participeChampionnat($idChampionnat, $idEquipe, $actif = 0)
    {
        $sql = "INSERT INTO participe(idChampionnat, idEquipe, actif) VALUES (?, ?, ?);";
        
        $data = [            
            $idChampionnat,
            $idEquipe,
            $actif// actif est mis à 0 par défaut
        ];

        return database::dbRun($sql, $data);
    }

    /**

     *Crée un nouveau championnat avec le nom, la saison et l'ID du sportif spécifiés.
     *
     *@param string $nomChampionnat Nom du championnat à créer
     *@param string $saison Saison du championnat à créer
     *@param int $idSportif ID du sportif créant le championnat
     *@return void
    */  
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

    /**

     *Met tous les championnats inactifs en une seule requête
     *
     *@return PDOStatement Résultat de la requête de mise à jour
    */
    public static function setAllChampionnatInnactiv()
    {
        $sql = "UPDATE championnat SET actif = ? WHERE actif = ?";

        $data=[
            0,
            1
        ];
        
        return database::dbRun($sql, $data);
    }

    /**

     *Sélectionne tous les championnats en fonction de l'ID du coach spécifié.
     *
     *@param int $idCoach ID du coach dont on veut récupérer les championnats.
     *
     *@return array Tableau associatif contenant les informations des championnats récupérés.
    */
    public static function selectAllChampionnatFromIdCoach($idCoach)
    {
        $sql = "SELECT * FROM championnat WHERE idSportif = ?";
        $data = [
            $idCoach
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**

     *Supprime un championnat en fonction de son identifiant.
    
     *@param int $idChampionnat Identifiant du championnat à supprimer.
     *@return void
    */
    public static function deleteChampionnatById($idChampionnat){
        $sql = "DELETE FROM championnat WHERE idChampionnat = ?";
        $data = [
            $idChampionnat,
        ];

        // Supprime le championnat de la base de données
        database::dbRun($sql, $data); 
    }

    /**
     *Récupère les informations d'un championnat spécifié par son ID.
    
     *@param int $idChampionnat ID du championnat à récupérer.
     *@return array Tableau associatif contenant les informations du championnat.
    */
    public static function selectChampionnatByID($idChampionnat)
    {
        $sql = "SELECT * FROM championnat WHERE idChampionnat = ?";
        $data = [
            $idChampionnat
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    /**

     *Met à jour le nom d'un championnat avec l'identifiant spécifié.
     *
     *@param string $nomChampionnat Nouveau nom du championnat
     *@param int $idChampionnat Identifiant du championnat à mettre à jour
     *@return bool Renvoie TRUE si la mise à jour a été effectuée avec succès, FALSE sinon
    */
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
    public static function desactiverChampionnat($idChampionnat, $idEquipe, $justeDesactiver = 0)
    {
        $sql = "UPDATE participe SET actif = ? WHERE actif = ? AND idEquipe = ?";

        $data=[
            0,
            1,
            $idEquipe
        ];

        
        
        database::dbRun($sql, $data);

        if(ChampionnatModel::checkIfEquipeIsInTheChampionnat($idEquipe, $idChampionnat) == null)
        {
            ChampionnatModel::participeChampionnat($idChampionnat, $idEquipe, 1);
        }

        if($justeDesactiver == 0)
        {
            ChampionnatModel::mettreChampionnatActif($idChampionnat, $idEquipe);
        }   
        
    }

    /**
     * Récupère l'identifiant du championnat actif, s'il y en a un
     * 
     * @return int|null L'identifiant du championnat actif, ou null s'il n'y en a pas
     */
    public static function isActive($idEquipe)
    {
        $sql = "SELECT idChampionnat FROM participe WHERE actif = ? AND idEquipe = ?";
        $data = [
            1,
            $idEquipe
        ];
        $result = database::dbRun($sql, $data)->fetchColumn();
        return $result !== false ? $result : null;
    }

    /**

     *Sélectionne tous les championnats dont l'ID du sportif n'est pas égal à celui spécifié.
    
     *@param int $idCoach ID du sportif pour lequel les championnats ne doivent pas être sélectionnés.
     *@return array Renvoie un tableau contenant tous les championnats dont l'ID du sportif n'est pas égal à celui spécifié.
    */
    public static function selectOthersChampionnat($idCoach)
    {
        $sql = "SELECT * FROM championnat WHERE idSportif != ?";
        $data = [
            $idCoach
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**

     *Vérifie si une équipe participe à un championnat spécifié.
    
     *@param int $idEquipe L'ID de l'équipe à vérifier.
     *@param int $idChampionnat L'ID du championnat à vérifier.
     *@return array|null Retourne un tableau associatif contenant les informations de la participation de l'équipe
     *au championnat, ou null si l'équipe ne participe pas au championnat.
    */
    public static function checkIfEquipeIsInTheChampionnat($idEquipe, $idChampionnat)
    {
        $sql = "SELECT * FROM participe WHERE idEquipe = ? AND idChampionnat = ?";
        $data = [
            $idEquipe,
            $idChampionnat
        ];
        $result =  database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);

        return $result !== false ? $result : null;
    }
    
    

    
    

    

}
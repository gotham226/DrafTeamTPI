<?php
/**
 * Auteur: Gabriel Martin
 * Date: 03.05.2023
 * Description: Page contenant toutes les requêtes concernant les equipe
 * Version 1.0
 */

namespace drafteam\Models;
use drafteam\Models\database;
use drafteam\Models\UserModel;

use PDO;

class EquipeModel
{
    /**

     *Crée une nouvelle équipe avec un nom, un écusson, un entraîneur et un lieu donnés
     *
     *@param string $nomEquipe Nom de l'équipe
     *@param string $nomEcusson Nom de l'écusson de l'équipe
     *@param int $idEntraineur ID de l'utilisateur qui sera l'entraîneur de l'équipe
     *@param int $idLieu ID du lieu où sera basée l'équipe
     *@return bool Succès ou échec de la création de l'équipe
    */
    public static function createNewteam($nomEquipe, $nomEcusson, $idEntraineur, $idLieu){
        $sql = "INSERT INTO equipe(nomEquipe, ecusson, idLieu) VALUES (?, ?, ?);";
        
        $data = [            
            $nomEquipe,             
            $nomEcusson,            
            $idLieu
        ];

        database::dbRun($sql, $data);

        // Stocke l'id de l'équipe dans la session
        $_SESSION['idEquipe'] = database::Db()->lastInsertId();

        // Met à jour l'équipe pour l'utilisateur entraîneur
        return UserModel::UpdateTeamForAUser($idEntraineur, $_SESSION['idEquipe']);
    }

    /**
     *Récupère les informations d'une équipe en fonction de son ID
    
     *@param int $idEquipe ID de l'équipe
     *@return array|false Renvoie un tableau associatif contenant les informations de l'équipe ou false si l'équipe n'existe pas
    */
    public static function selectATeamById($idEquipe){
        $sql = "SELECT * FROM equipe WHERE idEquipe = ?";
        $data = [
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    /**

     *Supprime une équipe en fonction de son ID
     *
     *@param int $idEquipe ID de l'équipe à supprimer
    */
    public static function deleteTeamById($idEquipe){
        $sql = "DELETE FROM equipe WHERE idEquipe = ?";
        $data = [
            $idEquipe,
        ];

        database::dbRun($sql, $data); 
    }
    /**
    *Met à jour les informations d'une équipe en fonction de son ID de session
    *
    *@param string $nomEquipe Nom de l'équipe
    *@param string $ecusson Chemin de l'écusson de l'équipe
    *@param int $idLieu ID du lieu d'entraînement de l'équipe
    *@return bool Retourne true si la mise à jour a été effectuée avec succès, sinon false
    */
    public static function updateTeam($nomEquipe, $ecusson, $idLieu)
    {
        $sql = "UPDATE equipe SET nomEquipe = ?, ecusson = ?, idLieu = ? WHERE idEquipe = ?";

        $data=[
            $nomEquipe,
            $ecusson,
            $idLieu,
            $_SESSION['idEquipe']
        ];
        
        return database::dbRun($sql, $data);
    }

    /**

     *Met à jour une équipe sans changer l'image de l'écusson

     *@param string $nomEquipe Nom de l'équipe
     *@param int $idLieu ID du lieu où l'équipe est basée
     *@return mixed Résultat de la requête
    */
    public static function updateTeamWithoutImage($nomEquipe, $idLieu)
    {
        $sql = "UPDATE equipe SET nomEquipe = ?, idLieu = ? WHERE idEquipe = ?";

        $data=[
            $nomEquipe,
            $idLieu,
            $_SESSION['idEquipe']
        ];
        
        return database::dbRun($sql, $data);
    }

    /**

     *Sélectionne toutes les équipes participantes à un championnat actif
    
     *en fonction de son ID.
     *@param int $idChampionnat ID du championnat
     *@return array Tableau associatif contenant les données des équipes participantes
    */
    public static function selectATeamByIdChampionnat($idChampionnat){
        $sql = "SELECT * 
                FROM equipe e 
                INNER JOIN participe p ON e.idEquipe = p.idEquipe 
                INNER JOIN championnat c ON p.idChampionnat = c.idChampionnat 
                WHERE c.idChampionnat = ? AND p.actif = 1;";
        $data = [
            $idChampionnat
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }





    
}
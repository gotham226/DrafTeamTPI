<?php
/**
 * Auteur: Gabriel Martin
 * Date: 03.05.2023
 * Description: Page contenant toute les requêtes concernant les equipe
 * Version 1.0
 */

namespace drafteam\Models;
use drafteam\Models\database;
use drafteam\Models\UserModel;

use PDO;

class EquipeModel
{
    // Crée une nouvelle équipe
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

    // Sélectionne une équipe en fonction de son id
    public static function selectATeamById($idEquipe){
        $sql = "SELECT * FROM equipe WHERE idEquipe = ?";
        $data = [
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    // Supprime une équipe en fonction de son id
    public static function deleteTeamById($idEquipe){
        $sql = "DELETE FROM equipe WHERE idEquipe = ?";
        $data = [
            $idEquipe,
        ];

        database::dbRun($sql, $data); 
    }

    // Met à jour une équipe
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

    // Met à jour une équipe sans l'image
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

    // Sélectionne une équipe en fonction de l'id d'un championnat
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
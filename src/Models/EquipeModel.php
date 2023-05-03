<?php

namespace drafteam\Models;
use drafteam\Models\database;
use drafteam\Models\UserModel;

use PDO;

class EquipeModel
{
    public static function createNewteam($nomEquipe, $nomEcusson, $idEntraineur, $idLieu){
        $sql = "INSERT INTO equipe(nomEquipe, ecusson, idLieu) VALUES (?, ?, ?);";
        
        $data = [            
            $nomEquipe,             
            $nomEcusson,            
            $idLieu
        ];

        database::dbRun($sql, $data);

        $_SESSION['idEquipe'] = database::Db()->lastInsertId();

        return UserModel::UpdateTeamForAUser($idEntraineur, $_SESSION['idEquipe']);
    }

    public static function selectATeamById($idEquipe){
        $sql = "SELECT * FROM equipe WHERE idEquipe = ?";
        $data = [
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }


    public static function deleteTeamById($idEquipe){
        $sql = "DELETE FROM equipe WHERE idEquipe = ?";
        $data = [
            $idEquipe,
        ];
    
        database::dbRun($sql, $data); 
    }
    
        
    
}
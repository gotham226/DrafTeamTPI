<?php

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class UserModel
{
    public static function checkIfEmailExist($email)
    {
        $sql = "SELECT * FROM sportif WHERE email = ?";
        $data = [
            $email
        ];
        
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function registerUser($nom, $prenom, $email, $mdp, $numTel, $dateNaissance, $photoProfil, $photoBaniere, $idPost, $idEquipe)
    {
        $sql = "INSERT INTO sportif(nom, prenom, dateNaissance, photo, email, motDePasse, telephone, idPoste, baniere, idEquipe) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        
        $data = [            
            $nom,             
            $prenom,            
            $dateNaissance,            
            $photoProfil,
            $email,
            $mdp,
            $numTel,
            $idPost,
            $photoBaniere,
            $idEquipe
        ];

        return database::dbRun($sql, $data);
    }

    public static function takeUserByEmail($email)
    {
        $sql = "SELECT * FROM sportif WHERE email = ?";
        $data = [
            $email
        ];
        
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    public static function connexionCheck($email)
    {
        $sql = "SELECT * FROM sportif WHERE email = ?";
        $data = [
            $email
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function UpdateTeamForAUser($idSportif, $idEquipe)
    {
        $sql = "UPDATE sportif SET idEquipe = ? WHERE idSportif = ?";

        $data=[
            $idEquipe,
            $idSportif
        ];
        
        return database::dbRun($sql, $data);
    }

    public static function deleteAllUserWithoutTeam()
    {
        $sql = "DELETE FROM sportif WHERE idEquipe = ? AND idPoste !=?";

        $data=[
            NULL,
            1
        ];
        
        return database::dbRun($sql, $data);
    }

    public static function takeTheCoach($idEquipe)
    {
        $sql = "SELECT * FROM sportif WHERE idPoste = ? AND idEquipe = ?";
        $data = [
            1,
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }
    

    public static function takePlayerByIdEquipe($idEquipe)
    {
        $sql = "SELECT * FROM sportif s INNER JOIN poste p ON s.idPoste = p.idPoste WHERE p.admin = 0 AND p.staff = 0 AND s.idEquipe = ?";
        $data = [
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function takeStaffByIdEquipe($idEquipe)
    {
        $sql = "SELECT * FROM sportif s 
        INNER JOIN poste p ON s.idPoste = p.idPoste 
        WHERE p.admin = 0 AND p.staff = 1 
        AND s.idEquipe = ?";
        $data = [
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteUserById($idSportif)
    {
        $sql = "DELETE FROM sportif WHERE idSportif = ?";

        $data=[
            $idSportif
        ];
        
        return database::dbRun($sql, $data);
    }

    public static function selectUserById($idSportif)
    {
        $sql = "SELECT * FROM sportif WHERE idSportif = ?";
        $data = [
            $idSportif
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    public static function UpdatePosteForAUser($idSportif, $idPoste)
    {
        $sql = "UPDATE sportif SET idPoste = ? WHERE idSportif = ?";

        $data=[
            $idPoste,
            $idSportif
        ];
        
        return database::dbRun($sql, $data);
    }

    public static function takeAllPeopleByIdEquipe($idEquipe)
    {
        $sql = "SELECT * FROM sportif WHERE idEquipe = ?";
        $data = [
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateUser($idSportif, $nom, $prenom, $dateNaissance, $numTel, $email, $nomprofil, $nomBaniere)
    {
        $sql = "UPDATE sportif SET nom = ?, prenom = ?, dateNaissance = ?, telephone = ?, email = ?, photo = ?, baniere = ?  WHERE idSportif = ?";

        $data=[
            $nom,
            $prenom,
            $dateNaissance,
            $numTel,
            $email,
            $nomprofil,
            $nomBaniere,
            $idSportif
        ];
        
        return database::dbRun($sql, $data);
    }

    public static function deleteUserByIdEquipe($idEquipe)
    {
        $sql = "DELETE FROM sportif WHERE idEquipe = ? AND idPoste != ?";

        $data=[
            $idEquipe,
            1
        ];
        
        return database::dbRun($sql, $data);
    }


}
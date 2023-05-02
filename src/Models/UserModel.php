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

    public static function registerUser($nom, $prenom, $email, $mdp, $numTel, $dateNaissance, $photoProfil, $photoBaniere, $idPost)
    {
        $sql = "INSERT INTO sportif(nom, prenom, dateNaissance, photo, email, motDePasse, telephone, idPoste, baniere) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        
        

        $data = [            
            $nom,             
            $prenom,            
            $dateNaissance,            
            $photoProfil,
            $email,
            $mdp,
            $numTel,
            $idPost,
            $photoBaniere
        ];

        return database::dbRun($sql, $data);
    }

    public static function takeIdByEmail($email)
    {
        $sql = "SELECT idSportif FROM sportif WHERE email = ?";
        $data = [
            $email
        ];
        
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }
    
}
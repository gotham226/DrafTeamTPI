<?php
/**
 * Auteur: Gabriel Martin
 * Date: 04.05.2023
 * Description: Page contenant toutes les requêtes concernant les utilisateurs
 * Version 1.0
 */

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class UserModel
{
    /**
    * Vérifie si un email existe dans la table sportif
    *
    * @param string $email Email à vérifier
    * @return array Tableau associatif contenant les informations du sportif correspondant à l'email spécifié, ou un tableau vide s'il n'existe pas
    */
    public static function checkIfEmailExist($email)
    {
        $sql = "SELECT * FROM sportif WHERE email = ?";
        $data = [
            $email
        ];
        
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    * Enregistre un utilisateur dans la base de données
    *
    * @param string $nom Nom de l'utilisateur
    * @param string $prenom Prénom de l'utilisateur
    * @param string $email Adresse email de l'utilisateur
    * @param string $mdp Mot de passe de l'utilisateur
    * @param string $numTel Numéro de téléphone de l'utilisateur
    * @param string $dateNaissance Date de naissance de l'utilisateur
    * @param string $photoProfil Nom du fichier de la photo de profil de l'utilisateur
    * @param string $photoBaniere Nom du fichier de la photo de bannière de l'utilisateur
    * @param int $idPost ID du poste occupé par l'utilisateur
    * @param int $idEquipe ID de l'équipe à laquelle l'utilisateur appartient
    * @return bool Renvoie vrai si l'insertion a été effectuée avec succès, faux sinon
    */
    public static function registerUser($nom, $prenom, $email, $mdp, $numTel, $dateNaissance, $photoProfil, $photoBaniere, $idPost, $idEquipe)
    {
        $sql = "INSERT INTO sportif(nom, prenom, dateNaissance, photo, email, motDePasse, telephone, idPoste, baniere, idEquipe) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        
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

    /**
    * Récupère les informations d'un utilisateur à partir de son adresse email
    *
    * @param string $email Adresse email de l'utilisateur
    * @return array|false Renvoie un tableau associatif contenant les informations de l'utilisateur si l'utilisateur existe, faux sinon
    */
    public static function takeUserByEmail($email)
    {
        $sql = "SELECT * FROM sportif WHERE email = ?";
        $data = [
            $email
        ];
        
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    /**
    * Vérifie si un utilisateur avec l'adresse e-mail donnée existe déjà
    *
    * @param string $email Adresse e-mail de l'utilisateur à vérifier
    * @return array|false Renvoie un tableau associatif contenant les informations utilisateur si l'utilisateur existe, false sinon
    */
    public static function connexionCheck($email)
    {
        $sql = "SELECT * FROM sportif WHERE email = ?";
        $data = [
            $email
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
    * Met à jour l'équipe d'un joueur
    *
    * @param int $idSportif ID du joueur
    * @param int $idEquipe ID de l'équipe à assigner
    * @return bool Renvoie vrai si la mise à jour a été effectuée avec succès, faux sinon
    */
    public static function UpdateTeamForAUser($idSportif, $idEquipe)
    {
        $sql = "UPDATE sportif SET idEquipe = ? WHERE idSportif = ?";

        $data=[
            $idEquipe,
            $idSportif
        ];
        
        return database::dbRun($sql, $data);
    }

    /**
    * Supprime tous les utilisateurs qui n'ont pas d'équipe attribuée et qui ne sont pas des entraîneurs
    *
    * @return int Retourne le nombre d'utilisateurs supprimés avec succès
    */
    public static function deleteAllUserWithoutTeam()
    {
        $sql = "DELETE FROM sportif WHERE idEquipe = ? AND idPoste !=?";

        $data=[
            NULL,
            1
        ];
        
        return database::dbRun($sql, $data);
    }

    /**
    * Récupère les informations du coach d'une équipe donnée
    *
    * @param int $idEquipe ID de l'équipe dont on veut récupérer le coach
    * @return array|false Renvoie un tableau associatif contenant les informations du coach, ou false si aucun coach n'est trouvé
    */
    public static function takeTheCoach($idEquipe)
    {
        $sql = "SELECT * FROM sportif WHERE idPoste = ? AND idEquipe = ?";
        $data = [
            1,
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
    * Récupère la liste des joueurs d'une équipe donnée
    *
    * @param int $idEquipe ID de l'équipe
    * @return array Renvoie un tableau associatif contenant la liste des joueurs de l'équipe
    */
    public static function takePlayerByIdEquipe($idEquipe)
    {
        $sql = "SELECT * FROM sportif s INNER JOIN poste p ON s.idPoste = p.idPoste WHERE p.admin = 0 AND p.staff = 0 AND s.idEquipe = ?";
        $data = [
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**

     *Récupère le staff d'une équipe en fonction de son ID

     *@param int $idEquipe ID de l'équipe
     *@return array Tableau associatif contenant les données des membres du personnel de l'équipe
    */
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

    /**
     *Supprime un utilisateur en fonction de son ID

     *@param int $idSportif ID de l'utilisateur à supprimer
     *@return bool Renvoie vrai si la suppression a été effectuée avec succès, faux sinon
    */
    public static function deleteUserById($idSportif)
    {
        $sql = "DELETE FROM sportif WHERE idSportif = ?";

        $data=[
            $idSportif
        ];
        
        return database::dbRun($sql, $data);
    }

    /**

     *Sélectionne un utilisateur par son ID
     *@param int $idSportif ID de l'utilisateur
     *@return array|false Retourne un tableau associatif contenant les informations de l'utilisateur si trouvé, ou false sinon
    */
    public static function selectUserById($idSportif)
    {
        $sql = "SELECT * FROM sportif WHERE idSportif = ?";
        $data = [
            $idSportif
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    /**

     *Met à jour le poste d'un utilisateur en fonction de son ID utilisateur
     *@param int $idSportif ID de l'utilisateur
     *@param int $idPoste ID du nouveau poste de l'utilisateur
    */
    public static function UpdatePosteForAUser($idSportif, $idPoste)
    {
        $sql = "UPDATE sportif SET idPoste = ? WHERE idSportif = ?";

        $data=[
            $idPoste,
            $idSportif
        ];
        
        return database::dbRun($sql, $data);
    }

    /**
     * Récupère toutes les personnes appartenant à une équipe en fonction de l'ID de l'équipe
     * 
     * @param int $idEquipe ID de l'équipe
     * @return array Tableau associatif contenant les informations des personnes appartenant à l'équipe
    */
    public static function takeAllPeopleByIdEquipe($idEquipe)
    {
        $sql = "SELECT * FROM sportif WHERE idEquipe = ?";
        $data = [
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**

     *Met à jour les informations d'un utilisateur dans la base de données
     *@param int $idSportif ID de l'utilisateur à mettre à jour
     *@param string $nom Nom de l'utilisateur
     *@param string $prenom Prénom de l'utilisateur
     *@param string $dateNaissance Date de naissance de l'utilisateur au format AAAA-MM-JJ
     *@param string $numTel Numéro de téléphone de l'utilisateur
     *@param string $email Adresse email de l'utilisateur
     *@param string $nomprofil Nom du fichier photo de profil de l'utilisateur
     *@param string $nomBaniere Nom du fichier de la bannière de l'utilisateur
     *@return bool Renvoie TRUE en cas de succès, FALSE en cas d'erreur
    */
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

    /**
     * Supprime tous les sportifs d'une équipe sauf l'entraineur
     * 
     * @param int $idEquipe ID de l'équipe
     * @return bool Renvoie true si la suppression s'est bien déroulée, false sinon
    */

    public static function deleteUserByIdEquipe($idEquipe)
    {
        $sql = "DELETE FROM sportif WHERE idEquipe = ? AND idPoste != ?";

        $data=[
            $idEquipe,
            1
        ];
        
        return database::dbRun($sql, $data);
    }

    /**
     * Récupère tous les joueurs qui n'ont pas été invités à un événement donné
     * @param int $idEvenement ID de l'événement
     * @return array Un tableau associatif contenant les informations des joueurs non invités
    */
    public static function selectAllUninvitedPlayers($idEvenement, $idEquipe)
    {
        $sql = "SELECT *
        FROM sportif
        LEFT JOIN poste ON sportif.idPoste = poste.idPoste
        WHERE poste.staff = 0 AND poste.admin = 0 AND sportif.idEquipe = ? AND sportif.idSportif NOT IN (
            SELECT idSportif FROM etre_present WHERE idEvenement = ?)";

        $data = [
            $idEquipe,
            $idEvenement
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Sélectionne tous les membres du staff non invités à un événement pour une équipe donnée
     *
     * @param int $idEvenement ID de l'événement
     * @param int $idEquipe ID de l'équipe
     * @return array Renvoie un tableau contenant toutes les informations des membres du staff non invités à l'événement
    */
    public static function selectAllUninvitedStaff($idEvenement, $idEquipe)
    {
        $sql = "SELECT *
        FROM sportif
        LEFT JOIN poste ON sportif.idPoste = poste.idPoste
        WHERE poste.staff = 1 AND poste.admin = 0 AND sportif.idEquipe = ? AND sportif.idSportif NOT IN (
            SELECT idSportif FROM etre_present WHERE idEvenement = ? )";

        $data = [
            $idEquipe,
            $idEvenement
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function UpdateMdpForAUser($idSportif, $mdp)
    {
        $sql = "UPDATE sportif SET motDePasse = ? WHERE idSportif = ?";
        $data=[
            $mdp,
            $idSportif
        ];
        
        return database::dbRun($sql, $data);
    }

}
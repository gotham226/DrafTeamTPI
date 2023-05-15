<?php
/**
 * Auteur: Gabriel Martin
 * Date: 08.05.2023
 * Description: Page contenant toutes les requêtes concernant les événements
 * Version 1.0
 */

namespace drafteam\Models;
use drafteam\Models\database;

use PDO;

class EventModel
{   
    
    /**
     * Crée un nouvel événement
     * 
     * @param string $nom Nom de l'événement
     * @param string $description Description de l'événement
     * @param int $type ID du type de l'événement
     * @param int $lieu ID du lieu de l'événement
     * @param string $debut Date et heure de début de l'événement (format: YYYY-MM-DD HH:mm:ss)
     * @param string $fin Date et heure de fin de l'événement (format: YYYY-MM-DD HH:mm:ss)
     * @return bool Renvoie true si l'événement a été créé avec succès, false sinon
     */
    public static function createNewEvent($nom, $description, $type, $lieu, $debut, $fin)
    {
        // Récupère la date de l'événement 
        $dateEvenement = substr($fin, 0, 10);

        $sql = "INSERT INTO evenement(nomEvenement, description, dateEvenement, heureDebut, heureFin, idType, idLieu, idSportif, idEquipe) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        
        $data = [            
            $nom,             
            $description,            
            $dateEvenement,            
            $debut,
            $fin,
            $type,
            $lieu,
            $_SESSION['idSportif'],
            $_SESSION['idEquipe']
        ];

        return database::dbRun($sql, $data);
    }


    /**
     * Sélectionne un événement par son ID
     * 
     * @param int $idEvent ID de l'événement à sélectionner
     * @return array Tableau associatif contenant les informations de l'événement sélectionné, ou null si l'événement n'existe pas
     */
    public static function selectEventById($idEvent){
        $sql = "SELECT * FROM evenement WHERE idEvenement = ?";
        $data = [
            $idEvent
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Sélectionne les joueurs invités à un événement
     * 
     * @param int $idEvent ID de l'événement
     * @return array Tableau associatif contenant les informations des joueurs invités à l'événement
     */
    public static function selectGuestPlayer($idEvent)
    {
        $sql = "SELECT sportif.*
        FROM sportif
        INNER JOIN etre_present ON sportif.idSportif = etre_present.idSportif
        LEFT JOIN poste ON sportif.idPoste = poste.idPoste
        WHERE poste.staff = 0 AND poste.admin = 0 AND etre_present.idEvenement = ? ORDER BY etre_present.present DESC";

        $data = [
            $idEvent
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Sélectionne les joueurs invités qui sont membres du staff à un événement
     * 
     * @param int $idEvent ID de l'événement
     * @return array Tableau associatif contenant les informations des joueurs invités membres du staff à l'événement
     */
    public static function selectGuestStaff($idEvent)
    {
        $sql = "SELECT sportif.*
        FROM sportif
        INNER JOIN etre_present ON sportif.idSportif = etre_present.idSportif
        LEFT JOIN poste ON sportif.idPoste = poste.idPoste
        WHERE poste.staff = 1 AND poste.admin = 0 AND etre_present.idEvenement = ? ORDER BY etre_present.present DESC";

        $data = [
            $idEvent
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

   /**
    * Supprime un événement de la base de données

    * @param int $idEvent ID de l'événement à supprimer
    * @return void
    */
    public static function deleteEvent($idEvent)
    {
        if(EventModel::selectEventById($idEvent)['image'] != "" && EventModel::selectEventById($idEvent)['image'] != null)
        {
            unlink('./assets/image/'.EventModel::selectEventById($idEvent)['image']);
        }   
        

        $sql = "DELETE FROM etre_present
        WHERE idEvenement = ?";

        $data = [
            $idEvent
        ];
        database::dbRun($sql, $data);


        $sql = "DELETE FROM evenement
        WHERE idEvenement = ?";

        $data = [
            $idEvent
        ];
        database::dbRun($sql, $data);

    }

    /**
     * Met à jour l'image associée à un événement
     * 
     * @param string $nomImage Nom de l'image à associer à l'événement
     * @param int $idEvenement ID de l'événement
     * @return bool Renvoie TRUE si la mise à jour s'est bien déroulée, FALSE sinon
     */
    public static function updateImageEvent($nomImage, $idEvenement)
    {
        $sql = "UPDATE evenement SET image = ? WHERE idEvenement = ?";

        $data=[
            $nomImage,
            $idEvenement
        ];
        
        return database::dbRun($sql, $data);
    }

    /**
     * Met à jour les informations d'un événement sans changer l'image
     * 
     * @param string $nom Le nouveau nom de l'événement
     * @param string $description La nouvelle description de l'événement
     * @param int $type L'ID du nouveau type d'événement
     * @param int $lieu L'ID du nouveau lieu de l'événement
     * @param string $debut La nouvelle heure de début de l'événement
     * @param string $fin La nouvelle heure de fin de l'événement
     * @param int $idEvenement L'ID de l'événement à mettre à jour
     * @return bool Renvoie true si la mise à jour a été effectuée avec succès, false sinon
     */
    public static function updateEventWithoutImage($nom, $description, $type, $lieu, $debut, $fin, $idEvenement)
    {
        $sql = "UPDATE evenement SET nomEvenement = ?, description = ?, idType = ?, idLieu = ?, heureDebut = ?, heureFin = ?  WHERE idEvenement = ?";

        $data=[
            $nom,
            $description,
            $type,
            $lieu,
            $debut,
            $fin, 
            $idEvenement
        ];
        
        return database::dbRun($sql, $data);
    }

    /**
     * Met à jour les informations d'un événement avec une image

     * @param string $nom Nom de l'événement
     * @param string $description Description de l'événement
     * @param int $type ID du type de l'événement
     * @param int $lieu ID du lieu de l'événement
     * @param string $debut Date et heure de début de l'événement (format Y-m-d H:i:s)
     * @param string $fin Date et heure de fin de l'événement (format Y-m-d H:i:s)
     * @param int $idEvenement ID de l'événement à mettre à jour
     * @param string $image Nom de l'image de l'événement
     * @return bool Retourne true si la mise à jour a réussi, false sinon
     */
    public static function updateEvent($nom, $description, $type, $lieu, $debut, $fin, $idEvenement, $image)
    {
        $sql = "UPDATE evenement SET nomEvenement = ?, description = ?, idType = ?, idLieu = ?, heureDebut = ?, heureFin = ?, image = ?  WHERE idEvenement = ?";

        $data=[
            $nom,
            $description,
            $type,
            $lieu,
            $debut,
            $fin, 
            $image,
            $idEvenement
        ];
        
        return database::dbRun($sql, $data);
    }

    /**
     * Sélectionne les 5 prochains événements à venir pour une équipe
     * 
     * @param int $idEquipe ID de l'équipe
     * @return array Tableau associatif contenant les informations des 5 prochains événements à venir pour l'équipe
     */
    public static function selectNextFiveEvent($idEquipe){
        $sql = "SELECT *
        FROM evenement
        WHERE heureDebut >= NOW() AND idEquipe = ?
        ORDER BY heureDebut ASC
        LIMIT 5;";
        $data = [
            $idEquipe
        ];
        return database::dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *Invite un sportif à un événement
     *
     *@param int $idSportif ID du joueur à inviter
     *@param int $idEvenement ID de l'événement auquel inviter le joueur
     *@return bool Renvoie true si l'invitation a été ajoutée avec succès, false sinon
    */
    public static function inviteAPlayerToEvent($idSportif, $idEvenement)
    {

        $sql = "INSERT INTO etre_present(idSportif, idEvenement) VALUES (?, ?);";
        
        $data = [            
            $idSportif,             
            $idEvenement
        ];

        return database::dbRun($sql, $data);
    }

    /**
     * Marque un joueur comme présent à un événement
     *
     * @param int $idSportif ID du joueur
     * @param int $idEvenement ID de l'événement
     * @return bool Renvoie vrai si la mise à jour a été effectuée avec succès, faux sinon
     */
    public static function metPresent($idSportif, $idEvenement)
    {

        $sql = "UPDATE etre_present SET present = ?, commentaire = ? WHERE idSportif = ? AND idEvenement = ?;";
        
        $data = [         
            1,   
            "",
            $idSportif,             
            $idEvenement
        ];

        return database::dbRun($sql, $data);
    }

    /**
     *Récupère les informations d'un joueur invité à un événement

     *@param int $idSportif ID du joueur
     *@param int $idEvenement ID de l'événement
     *@return array|false Renvoie un tableau associatif contenant les informations du joueur invité à l'événement, ou faux s'il n'est pas invité
    */
    public static function checkIfImInvited($idSportif, $idEvenement)
    {

        $sql = "SELECT * FROM etre_present WHERE idEvenement = ? AND idSportif = ?";
        $data = [
            $idEvenement,
            $idSportif
        ];
        return database::dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    /**
    * Marque un joueur comme absent à un événement avec une raison donnée
    *
    * @param int $idSportif ID du joueur
    * @param int $idEvenement ID de l'événement
    * @param string $raison Raison de l'absence
    * @return bool Renvoie vrai si la mise à jour a été effectuée avec succès, faux sinon
    */
    public static function metAbsentAvecRaison($idSportif, $idEvenement, $raison)
    {

        $sql = "UPDATE etre_present SET present = ?, commentaire = ? WHERE idSportif = ? AND idEvenement = ?;";
        
        $data = [         
            0,   
            $raison,
            $idSportif,             
            $idEvenement
        ];

        return database::dbRun($sql, $data);
    }

    /**
    * Met à jour le score d'un événement
    *
    * @param int $idEvenement ID de l'événement
    * @param string $resultat Score sous forme de chaîne de caractères
    * @return bool Renvoie vrai si la mise à jour a été effectuée avec succès, faux sinon
    */
    public static function setScore($idEvenement, $resultat)
    {

        $sql = "UPDATE evenement SET resultat = ? WHERE idEvenement = ?;";
        
        $data = [         
            $resultat,   
            $idEvenement
        ];

        return database::dbRun($sql, $data);
    }

    public static function deleteImgFromEvent($idEvenement)
    {
        unlink('./assets/image/'.EventModel::selectEventById($idEvenement)['image']);

        $sql = "UPDATE evenement SET image = NULL WHERE idEvenement = ?";

        $data = [
            $idEvenement
        ];
        database::dbRun($sql, $data);

    }

    






}
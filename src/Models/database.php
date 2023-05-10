<?php
/**
 * Auteur: Gabriel Martin
 * Date: 02.05.2023
 * Description: Page contenant la connexion à la base de données et une foncion qui execute les requêtes
 * Version 1.0
 */

namespace drafteam\Models;

use PDO;

require_once "../src/Models/config.php";

class database 
{
    /*
     * Connexion base de données 
     */
    public static function Db()
    {

        static $pdo = null;

        if ($pdo == null) {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";

            $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        return $pdo;
    }
    /*
     * Execute la requête
     * 
     * @param string $sql Requete sql
     * @param string $param Les différents paramètres de la requete 
     */
    public static function dbRun($sql, $param = null)
    {
        $statement = database::Db()->prepare($sql);

        $result = $statement->execute($param);

        return $statement;
    }

}
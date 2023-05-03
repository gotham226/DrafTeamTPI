<?php

namespace drafteam\Controllers;
use drafteam\Models\ChampionnatModel;
use drafteam\Models\UserModel;

session_start();

class CreationChampionnatController
{
    public function creationChampionnat()
    {
        if(!isset($_SESSION['entraineur'])){

            header('Location: /');
            exit;
        }
        
        $nomChampionnat = filter_input(INPUT_POST, 'nomChampionnat', FILTER_SANITIZE_STRING);

        $error="";

        if(isset($_POST['creerChampionnat']))
        {
            if($nomChampionnat != "")
            {
                $saison = date("Y");
                ChampionnatModel::creerNouveauChampionnat($nomChampionnat, $saison,$_SESSION['idSportif'] , 0);
                if($_SESSION['idEquipe']== null)
                {
                    header('Location: /creationEquipe');
                    exit;
                }
                else{
                    header('Location: /championnat');
                    exit;
                }

            }else{
                $error = "Tous les champs ne sont pas rensignés.";
            }
        }


        require_once('../src/Views/creationChampionnat.php');
    }
}
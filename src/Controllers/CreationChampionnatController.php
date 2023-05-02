<?php

namespace drafteam\Controllers;
use drafteam\Models\ChampionnatModel;
use drafteam\Models\UserModel;

session_start();

class CreationChampionnatController
{
    public function creationChampionnat()
    {
        $nomChampionnat = filter_input(INPUT_POST, 'nomChampionnat', FILTER_SANITIZE_STRING);
        $actif = filter_input(INPUT_POST, 'actif', FILTER_SANITIZE_STRING);

        $error="";

        if(isset($_POST['creerChampionnat']))
        {
            if($nomChampionnat != "" && $actif != "")
            {
                if($actif == "oui"){
                    ChampionnatModel::setAllChampionnatInnactiv();
                    // ChampionnatModel::unregisterInactiveChampionnat();
                    $isActif=1;
                }else{
                    $isActif=0;
                }
                $saison = date("Y");
                ChampionnatModel::creerNouveauChampionnat($nomChampionnat, $saison,$_SESSION['idSportif'] , $isActif);

            }else{
                $error = "Tous les champs ne sont pas rensigné.";
            }
        }


        require_once('../src/Views/creationChampionnat.php');
    }
}
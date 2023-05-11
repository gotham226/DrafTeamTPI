<?php
/**
 * Auteur: Gabriel Martin
 * Date: 02.05.2023
 * Description: Fichier de route pour la redirection de chaque url
 * Version 1.0
 */

use Pecee\SimpleRouter\SimpleRouter as Router;

use drafteam\Controllers\AccueilController;
use drafteam\Controllers\AgendaController;
use drafteam\Controllers\CreateEventController;
use drafteam\Controllers\GestionJoueursController;
use drafteam\Controllers\InscriptionController;
use drafteam\Controllers\ModifierProfilController;
use drafteam\Controllers\DeconnexionController;
use drafteam\Controllers\CreationChampionnatController;
use drafteam\Controllers\ConnexionController;
use drafteam\Controllers\ChampionnatController;
use drafteam\Controllers\DeleteChampionnatController;
use drafteam\Controllers\ModifierChampionnatController;
use drafteam\Controllers\CreationEquipeController;
use drafteam\Controllers\EquipeController;
use drafteam\Controllers\DeleteEquipeController;
use drafteam\Controllers\MettreActifController;
use drafteam\Controllers\ModifierEquipeController;
use drafteam\Controllers\CreationJoueurController;
use drafteam\Controllers\DeleteSportifController;
use drafteam\Controllers\ModifierSportifController;
use drafteam\Controllers\InfoChampionnatController;
use drafteam\Controllers\EvenementController;
use drafteam\Controllers\DeleteEvenementController;
use drafteam\Controllers\UploadController;
use drafteam\Controllers\ModifierEvenementController;
use drafteam\Controllers\InvitationEvenementController;
use drafteam\Controllers\JustifierAbsenceController;
use drafteam\Controllers\AffichageCommentaireController;
use drafteam\Controllers\ModifierScoreController;
use drafteam\Controllers\RejoindreChampionnatController;



Router::form('/', [AccueilController::class, 'accueil']);
Router::form('/agenda', [AgendaController::class, 'agenda']);
Router::form('/agendaEvent', [AgendaController::class, 'agendaEvent']);
Router::form('/createEvent', [CreateEventController::class, 'createEvent']);
Router::form('/gestionJoueurs', [GestionJoueursController::class, 'gestionJoueurs']);
Router::form('/inscription', [InscriptionController::class, 'inscription']);
Router::form('/modifierProfil', [ModifierProfilController::class, 'modifierProfil']);
Router::form('/deconnexion', [DeconnexionController::class, 'deconnexion']);
Router::form('/creationChampionnat', [CreationChampionnatController::class, 'creationChampionnat']);
Router::form('/connexion', [ConnexionController::class, 'connexion']);
Router::form('/championnat', [ChampionnatController::class, 'championnat']);
Router::form('/deleteChampionnat', [DeleteChampionnatController::class, 'deleteChampionnat']);
Router::form('/modifierChampionnat', [ModifierChampionnatController::class, 'modifierChampionnat']);
Router::form('/creationEquipe', [CreationEquipeController::class, 'creationEquipe']);
Router::form('/monEquipe', [EquipeController::class, 'equipe']);
Router::form('/deleteEquipe', [DeleteEquipeController::class, 'deleteEquipe']);
Router::form('/mettreActif', [MettreActifController::class, 'mettreActif']);
Router::form('/modifierEquipe', [ModifierEquipeController::class, 'modifierEquipe']);
Router::form('/creationJoueur', [CreationJoueurController::class, 'creationJoueur']);
Router::form('/deleteSportif', [DeleteSportifController::class, 'deleteUser']);
Router::form('/modifierSportif', [ModifierSportifController::class, 'modifierSportif']);
Router::form('/infoChampionnat', [InfoChampionnatController::class, 'infoChampionnat']);
Router::form('/evenement', [EvenementController::class, 'evenement']);
Router::form('/deleteEvenement', [DeleteEvenementController::class, 'deleteEvenement']);
Router::form('/upload', [UploadController::class, 'upload']);
Router::form('/modifierEvenement', [ModifierEvenementController::class, 'modifierEvenement']);
Router::form('/invitation', [InvitationEvenementController::class, 'invitationEvenement']);
Router::form('/justification', [JustifierAbsenceController::class, 'justification']);
Router::form('/affichageCommentaire', [AffichageCommentaireController::class, 'affichageCommentaire']);
Router::form('/modifierScore', [ModifierScoreController::class, 'modifierScore']);
Router::form('/rejoindreChampionnat', [RejoindreChampionnatController::class, 'rejoindreChampionnat']);
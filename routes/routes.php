<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

use drafteam\Controllers\AccueilController;
use drafteam\Controllers\AgendaController;
use drafteam\Controllers\CreateEventController;
use drafteam\Controllers\GestionJoueursController;
use drafteam\Controllers\InscriptionController;
use drafteam\Controllers\ModifierProfilController;
use drafteam\Controllers\DeconnexionController;
use drafteam\Controllers\CreationChampionnatController;


Router::form('/', [AccueilController::class, 'accueil']);
Router::form('/agenda', [AgendaController::class, 'agenda']);
Router::form('/agendaEvent', [AgendaController::class, 'agendaEvent']);
Router::form('/createEvent', [CreateEventController::class, 'createEvent']);
Router::form('/gestionJoueurs', [GestionJoueursController::class, 'gestionJoueurs']);
Router::form('/inscription', [InscriptionController::class, 'inscription']);
Router::form('/modifierProfil', [ModifierProfilController::class, 'modifierProfil']);
Router::form('/deconnexion', [DeconnexionController::class, 'deconnexion']);
Router::form('/creationChampionnat', [CreationChampionnatController::class, 'creationChampionnat']);

<?php

namespace drafteam\Controllers;

session_start();

class ModifierProfilController
{
    public function modifierProfil()
    {
        if(!isset($_SESSION['email'])){

            header('Location: /');
            
        }
        require_once('../src/Views/modifierProfil.php');
    }
}
<?php

namespace drafteam\Controllers;

session_start();

class ModifierProfilController
{
    public function modifierProfil()
    {
        require_once('../src/Views/modifierProfil.php');
    }
}
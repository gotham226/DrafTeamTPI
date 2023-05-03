<?php

namespace drafteam\Controllers;



session_start();

class DeconnexionController
{
    public function deconnexion()
    {
        if(!isset($_SESSION['email'])){

            header('Location: /');
            
        }
        session_destroy();
        header('Location: /');
        exit;
    }

}
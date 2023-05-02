<?php

namespace drafteam\Controllers;



session_start();

class DeconnexionController
{
    public function deconnexion()
    {
        session_destroy();
        header('Location: /');
        exit;
    }

}
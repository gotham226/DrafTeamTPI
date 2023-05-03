<?php

namespace drafteam\Controllers;

session_start();

class CreateEventController
{
    public function createEvent()
    {
        if(!isset($_SESSION['entraineur'])){

            header('Location: /');
            
        }

        require_once('../src/Views/createEvent.php');
    }
}
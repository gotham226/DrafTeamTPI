<?php

namespace drafteam\Controllers;

session_start();

class CreateEventController
{
    public function createEvent()
    {
        require_once('../src/Views/createEvent.php');
    }
}
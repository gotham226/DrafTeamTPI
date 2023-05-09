<?php

namespace drafteam\Controllers;
use drafteam\Models\UserModel;
use drafteam\Models\PosteModel;

session_start();

class UploadController
{
    public function upload()
    {
        if(!isset($_SESSION['email'])){

            header('Location: /');
            exit;
        }

        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        var_dump($_FILES['image']);
        
        

        require_once('../src/Views/aganda.php');
    }
}
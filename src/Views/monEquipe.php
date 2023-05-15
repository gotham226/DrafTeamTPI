<?php
/**
 * Auteur: Gabriel Martin
 * Date: 03.05.2023
 * Description: Page pour la vue de l'équipe
 * Version 1.0
 */

use drafteam\Models\PosteModel;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="64x64" href="./assets/img/iconeDT.png">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <!-- google font link -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,400&family=Poppins:wght@400;500;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Draft Team</title>
</head>

<body onload="DisplayAccueil();  GetWindowHeight();" id="collections" onresize="GetWindowHeight()">
    <!-- header section Début -->
    
    <a name="top"></a>
    <header class="header bg-white10 shadow">
        <?php
        require_once('inc/nav.php');
        ?>


    </header>
    

    <div id="pageProfil" style="text-align: center;margin-top:3%;">
        
        <div style="margin-bottom: 109px;">
            <div style="width: 100%; background-image: url('./assets/img/backGroundBaniereLogo-flou.jpg');"class="banniere" alt="ht " id="banniereUtil"> </div>
            

            <div class="infoProfil" style="width:100%; margin-left:0%;">
                        <img id="ppUtil" class="photoProfil " src="./assets/image/<?=$monEquipe['ecusson']?>">

                
                <h1 style="font-size:80px;"><?=$monEquipe['nomEquipe']?></h1>

                <?php
                if(isset($_SESSION['entraineur']) == true)
                {
                ?>
                    <div class="text-center"> <a href="modifierEquipe?idEquipe=<?=$_SESSION['idEquipe']?>" style="color: white;"> <button  style=" color: blue; background-color: #0a78df00; border: none;" class="material-icons button edit">edit</button> </a>
                    <a href="deleteEquipe?idEquipe=<?=$_SESSION['idEquipe']?>"> <button  style=" color: red; background-color: #0a78df00; border: none;"  class="material-icons button delete">delete</button> </a>
                    </div>
                    
                <?php
                }
                ?>
                
            </div>

        </div>

    </div>

    <br></br>

    <div style="width:100%; margin-top: 5%;" >
        <ul style="display: inline-flex; list-style: none; width: 100%; ">

            <li style="width:20%; margin-left:20%; font-size:20px;">
                <img src="./assets/img/icone_coach@3x.png" style="width:100%; "alt="">
                <h1 style="text-align:center;">Entraineur</h1>
                <br>
                
                <br>
                <div class="container spacer5 ta-center bg-purple" style="background-image: url('./assets/image/<?=$monCoach['baniere']?>'); width: 70%; background-size: cover;">
                    
                    <ul style="display: inline-flex; list-style: none; width:100%;height:100%;">
                        <li style="width:40%; margin-top: 2%;"><img style="width: 75%; height:96%; " class="photoProfil " src="./assets/image/<?=$monCoach['photo']?>"></li>
                        <li style="width:55%; margin-left: 10%; margin-top: 5%; margin-right:5%;"><h4  style="font-size: 80%;text-align: center; color:black; border-radius: 8px; background-color:white;"><?=$monCoach['prenom']?><br><?=$monCoach['nom']?></h4></li>
                    </ul>
                    <br>
                
                </div>
            </li>

            <li style="width:20%; font-size:20px;">
                <img src="./assets/img/milieu@3x.png" style="width:100%; "alt="">
                <h1 style="text-align:center;">Joueurs</h1>
                <br>
                <br>
                <?php
                
                if(isset($_SESSION['entraineur']))
                {
                ?>
                    <a href="/creationJoueur">
                        <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 70%;">
                            
                            <h2 style="text-align: center;font-size: 90px;color: white;">+</h2>
                            
                        </div>
                    </a>
                    
                    <br>
                <?php
                }

                foreach ($mesJoueurs as $joueur)
                {
                    
                ?>
                    <div class="container spacer5 ta-center bg-purple" style="background-image: url('./assets/<?php if($joueur['baniere'] == null){echo "img/fondBlanc.png";}else{echo "image/".$joueur['baniere'];} ?>'); width: 70%; background-size: cover;">
                    
                        <ul style="display: inline-flex; list-style: none; width:100%;height:100%;">
                            <li style="width:40%; margin-top: 2%;"><img style="width: 75%; height:96%; " class="photoProfil " src="./assets/<?php if($joueur['photo'] == null){echo "img/profileIcon.png";}else{echo "image/".$joueur['photo'];} ?>"></li>
                            <li style="width:45%; margin-left: 2%; margin-top: 2%; margin-right:12%;"><h4  style="font-size: 75%;text-align: center; color:black; border-radius: 8px; background-color:white; width:100%;"><?php if($joueur['prenom'] == null){echo $joueur['email'];}else{echo $joueur['prenom']."<br>".$joueur['nom']; }?><br><?php echo PosteModel::selectPosteById($joueur['idPoste'])['poste'];?></h4></li>
                            <?php
                            if(isset($_SESSION['entraineur']) == true)
                            {
                            ?>
                                <div class="text-center"> <a href="/modifierSportif?idSportif=<?=$joueur['idSportif']?>" style="color: white;"> <button  style=" color: blue; background-color: #0a78df00; border: none;" class="material-icons button edit">edit</button> </a>
                                <a href="/deleteSportif?idSportif=<?=$joueur['idSportif']?>"> <button  style=" color: red; background-color: #0a78df00; border: none;"  class="material-icons button delete">delete</button> </a>
                                </div>
                                
                            <?php
                            }?>
                        </ul>
                        <br>
                
                    </div>
                    <br>
                <?php
                }
                ?>
            </li>

            <li style="width:20%; font-size:20px;">
                <img src="./assets/img/entrainement2@3x.png" style="width:100%; "alt="">
                <h1 style="text-align:center;">Staffs</h1>
                <br>
                <br>
                <?php
                if(isset($_SESSION['entraineur']))
                {
                ?>
                    <a href="/creationJoueur">
                        <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 70%; background-size: cover;">
                            
                            <h2 style="text-align: center;font-size: 90px;color: white;">+</h2>
                            
                        </div>
                    </a>
                    
                <br>
                <?php
                }
                foreach ($monStaff as $staff)
                {
                    
                ?>
                    <div class="container spacer5 ta-center bg-purple" style="background-image: url('./assets/<?php if($staff['baniere'] == null){echo "img/fondBlanc.png";}else{echo "image/".$staff['baniere'];} ?>'); width: 70%; background-size: cover;">
                    
                        <ul style="display: inline-flex; list-style: none; width:100%;height:100%;">
                            <li style="width:40%; margin-top: 2%;"><img style="width: 75%; height:96%; " class="photoProfil " src="./assets/<?php if($staff['photo'] == null){echo "img/profileIcon.png";}else{echo "image/".$staff['photo'];} ?>"></li>
                            <li style="width:55%; margin-left: 2%; margin-top: 2%; margin-right:5%;"><h4  style="font-size: 80%;text-align: center; color:black; border-radius: 8px; background-color:white;"><?php if($staff['prenom'] == null){echo $staff['email'];}else{echo $staff['prenom']."<br>".$staff['nom']; }?><br><?php echo PosteModel::selectPosteById($staff['idPoste'])['poste'];?></h4></li>
                            <?php
                            if(isset($_SESSION['entraineur']) == true)
                            {
                            ?>
                                <div class="text-center"> <a href="/modifierSportif?idSportif=<?=$staff['idSportif']?>" style="color: white;"> <button  style=" color: blue; background-color: #0a78df00; border: none;" class="material-icons button edit">edit</button> </a>
                                <a href="/deleteSportif?idSportif=<?=$staff['idSportif']?>"> <button  style=" color: red; background-color: #0a78df00; border: none;"  class="material-icons button delete">delete</button> </a>
                                </div>
                                
                            <?php
                            }?>
                        </ul>
                            
                            </div>
                            <br>
                        <?php
                        }
                ?>
            </li>

        </ul>

    </div>
    <!-- footer section starts -->
    <footer class="spacer10">
        <div class="container row jc-between flexcol-s ta-center-s ">
            <div class="row flexcol spacebottom3-s spaceleft3-s">
                
            </div>
        </div>
    </footer>
    <!-- footer section ends -->

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- custom js file link -->
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/affichage.js"></script>


</body>

</html>



<!-- /**
 * Auteur: Gabriel Martin
 * Date: 08.05.2023
 * Description: Page pour la vue des informations d'un championnats
 * Version 1.0
 */ -->
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
      <!-- header section Fin -->
    
   

    <div id="creationProfil">
        <h1 class="size5 bold spacebottom1" style="text-align: center;margin-top: 6%;"><?=$championnat['nomChampionnat']." ".$championnat['saison']."/".$championnat['saison']+1?></h1>
        <?php
        foreach ($equipes as $equipe) 
        {
        ?>
            <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 20%;">
                <ul style="width: 100%;display: -webkit-box;align-items: flex-start;height: 95%;list-style:none; margin-left:1%; ">
                    <li style="height:92% margin-top:4%;"><img style=" height:100%; width:100%;" id="ppUtil" class="photoProfil " src="./assets/image/<?=$equipe['ecusson']?>"></li>
                    <li style="width:65%; margin-top:8%; margin-bottom: 4%;"><h1><?=$equipe['nomEquipe']?></h1></li>
                </ul>
            </div>

            <br></br>
        <?php
        }
        
        
        ?>
        
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
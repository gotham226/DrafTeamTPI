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

<body onload="GetWindowHeight();" id="collections" onresize="GetWindowHeight()">
    <!-- header section Début -->
    
    <a name="top"></a>
    <header class="header bg-white10 shadow">
        
    <?php
    require_once('inc/nav.php');
    ?>


    </header>


      <!-- header section Fin -->
   
        


    <div style="margin-top: 10%;">
        <h1 class="size5 bold spacebottom1" style="text-align: center;margin-top: 6%;">Créer votre <span
                class="lightpurple">évènement</span></h1>
        <form class="search-form" id="leForm">
            <h2 id="artisteH2" style="color: rgba(255, 255, 255, 0.5); margin-bottom: 3%;">Nom équipe</h2>
            <h1>Nom de votre oeuvre *</h1>
            <input type="text"  class="leInput" style="width: 100%;"><br>
            <h1>Description</h1>
            <textarea name=""  cols="30" rows="10" class="laDescription"></textarea><br>
            <img src="" id="imgUpload" alt=""><br>
            
            <input type="number" id="prix" placeholder="Prix *">
        </form>
        <div style="display: flex;justify-content: center;">
            <p id="msgAlerte"></p>
            <button href="" class="btn bg-purple size2 white">Publier</button>
        </div>
    </div>


    <!-- footer section starts -->
    <footer class="spacer10">
        <div class="container row jc-between flexcol-s ta-center-s ">
            <div class="row flexcol spacebottom3-s spaceleft3-s">
                
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/affichage.js"></script>


</body>

</html>
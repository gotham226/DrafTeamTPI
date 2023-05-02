<!DOCTYPE html>
<html lang="en">

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
    
   

    <div id="modifierProfil">
        <h1 class="size5 bold spacebottom1" style="text-align: center;margin-top: 6%;">Modifier le <span
                class="lightpurple">Profil</span></h1>
        <form action="#" method="post" style="margin: auto;">
            <input type="text" id="nomUtilModif" placeholder="Ajoutez votre pseudo">
            <input type="email" id="emailUtilModif" placeholder="Ton email">
            <textarea id="descriptionProjetModif" rows="4"
                placeholder="Ajoutez un Description a votre projet"></textarea>
            <label>Modifier votre photo de profil</label>
            <input type="file" accept="image/png, image/jpeg, image/jpg" id="outputPhotoProfilModif"
                onchange="LoadPhotoProfil(event)">
            <div id="imgUploadPhotoProfil"
                style="width: 5vw;height: 5vw; background-size: cover;background-position: center; border-radius: 100%;">
            </div>
            <label>Modifier votre bannière</label>
            <input type="file" accept="image/png, image/jpeg, image/jpg" id="outputBanniereModif"
                onchange="LoadBanniere(event)">
            <div id="imgUploadBanniere" alt="" style="width: 20vw;height: 7vw;">
                <br>
            </div>
            <button type="submit"  class="btn bg-purple size2 white"
                onclick="ModifierProfil(); DisplayAccueil()">Modifier</button>
        </form>
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
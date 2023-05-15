<!-- /**
 * Auteur: Gabriel Martin
 * Date: 10.05.2023
 * Description: Page pour la vue de la justification d'absence
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
      <!-- header section Fin -->
    
   

    <div>
        
        
            
        <h1 class="size5 bold spacebottom1" style="text-align: center; margin-top:7%;">Donnez une raison à votre absence</h1>
        <h3 class="size2 bold spacebottom1" style="text-align: center; color: red;"><?=$error?></h3>
        <form method="post" style="width: 100%; max-width: 100%;">
        <input type="text" name="raison" style="width: 25%; margin-left:38%; text-align:center;" placeholder="Raison :">
            <ul style="display: inline-flex; list-style: none; width: 100%;margin-top: 5%;">
                
                <li style="margin-left:42%;width: 10%;">
                    <button name="valider" style="width: 50%;" type="submit" class="btn bg-purple wallet">Valider</button> 
                </li>

                <li style=" width: 10%;">
                    <button style="width: 50%;" name="annuler" type="submit" class="btn bg-purple wallet">Annuler</button> 
                </li>
            </ul>
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
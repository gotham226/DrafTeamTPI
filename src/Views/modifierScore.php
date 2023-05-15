<!-- 
    /**
 * Auteur: Gabriel Martin
 * Date: 11.05.2023
 * Description: Page pour la vue de la modification du score
 * Version 1.0
 */
-->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="64x64" href="img/iconeDT.png">
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
        <h1 class="size3 bold" style="text-align: center;margin-top: 10%;">Modifier le score :</h1>
        <h1 class="size2 bold" style="text-align: center;margin-top: 2%; color:red;"><?=$error?></h1>
        <form method="post" style="margin-left:35%;">
            <ul style="display: inline-flex; list-style:none;">
                <li style="margin-right:4%;">
                    <label class="size2" >Domicile</label>
                    <input type="number" name="domicile" value="<?=$score1?>" id="">
                </li>

                <li style="margin-top:12%;  margin-right:4%;">
                    <h1 class="size4 bold spacebottom1" style="text-align: center;margin-top: 2%;">-</h1>
                </li>

                <li>
                    <label class="size2">Visiteur</label>
                    <input type="number" name="exterieur" value="<?=$score2?>" id="">
                </li>
            </ul>
            <button type="submit" name="validerEnregistrer"style="margin-left:40%;" class="btn bg-purple wallet">Valider</button> 
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
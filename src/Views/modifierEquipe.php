<!-- /**
 * Auteur: Gabriel Martin
 * Date: 03.05.2023
 * Description: Page pour la vue de la modification de l'équipe
 * Version 1.0
 */ -->
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
        <h1 class="size5 bold spacebottom1" style="text-align: center;margin-top: 10%;">Modification d'équipe</h1>
        <h2 style="color:red; text-align: center;"><?=$error?></h2>
        <form  method="post" style="margin: auto;" enctype="multipart/form-data">
            <label style="font-size: 20px; font-weight: bold;">Nom de l'équipe</label>
            <input type="text" name="nomEquipe" value="<?=$equipe['nomEquipe']?>">
            <br><br>
            <label style="font-size: 20px; font-weight: bold;">Ecusson</label>
            <input type="file" name="ecusson" accept="image/png, image/jpeg, image/jpg" id="outputPhotoProfil"
                onchange="LoadPhotoProfil(event)">
            <div id="imgUploadPhotoProfil"
                style="width: 5vw;height: 5vw; background-size: cover;background-position: center; border-radius: 100%;">
            </div>
            <label style="font-size: 20px; font-weight: bold;">Lieu du stade</label>
            <select name="lieu" style="border-radius: 8px;">
            <?php
            foreach ($lieus as $lieu) {
                ?>
                <!-- Pour Sélectionner la valeur dans la base de données par défaut -->
                <option style="color: black;" value="<?=$lieu['idLieu'];?>" <?php if($lieu['idLieu'] == $equipe['idLieu']){echo "selected";}?>><?=$lieu['nomLieu']?></option>
                <?php
            }
            ?>
                
            </select>
            <br><br>
            <button type="submit" class="btn bg-purple size2 white" name="modifierEquipe">Modifier l'équipe</button>
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
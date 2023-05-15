<!-- /**
 * Auteur: Gabriel Martin
 * Date: 08.05.2023
 * Description: Page pour la vue de de la modification du profil
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

    <div id="pageProfil" style="text-align: center;margin-top:3%;">
        
        <div style="margin-bottom: 109px;">
            <div style="width: 100%; background-image: url('./assets/image/<?=$sportif['baniere']?>');"class="banniere"  id="banniereUtil"> </div>
            

            <div class="infoProfil" style="width:100%; margin-left:0%;">
                        <?php
                        if($sportif['photo'] == null)
                        {
                        ?>
                            <img id="ppUtil" class="photoProfil " src="./assets/img/profileIcon.png">
                        <?php
                        }else
                        {
                        ?>
                            <img id="ppUtil" class="photoProfil " src="./assets/image/<?=$sportif['photo']?>">
                        <?php
                        }   
                        
                        ?>
                        

                
                <h1 style="font-size:50px;"><?=$sportif['email']?></h1>
                <?php
                if(isset($_SESSION['entraineur']) == true)
                {
                ?>
                    <img src="./assets/img/icone_coach@3x.png" style="width:25%; "alt="">
                    
                <?php
                }else if(isset($_SESSION['staff']) == true)
                {
                ?>

                    <img src="./assets/img/entrainement2@3x.png" style="width:25%; "alt="">

                <?php
                }else{
                    if($poste == "AT")
                    {
                    ?>
                        <img src="./assets/img/attaquant@3x.png" style="width:25%; "alt="">
                    <?php
                    }else if($poste = "MC")
                    {
                    ?>
                        <img src="./assets/img/millieu@3x.png" style="width:25%; "alt="">
                    <?php
                    }else if($poste = "DC")
                    {
                    ?>
                        <img src="./assets/img/defenseur@3x.png" style="width:25%; "alt="">
                    <?php
                    }else if($poste = "G")
                    {
                    ?>
                        <img src="./assets/img/goalkeeper@3x.png" style="width:25%; "alt="">
                    <?php
                    }
                }
                
                
                ?>
                
            </div>
            
        </div>

    </div>

    
    <div id="modifierProfil">
        <h1 class="size5 bold spacebottom1" style="text-align: center;margin-top: 20%;">Modifier mot de passe</h1>
        <h2 style="color:green; text-align: center;"><?=$messageMdp?></h2>
        <h2 style="color:red; text-align: center;"><?=$errorMdp?></h2>
        <form  method="post" style="margin: auto;" enctype="multipart/form-data">

            <label style="font-size: 20px; font-weight: bold;">Votre ancien mot de passe</label>
            <input type="password" name="ancienMdp" placeholder="*******">
            <br><br>

            <label style="font-size: 20px; font-weight: bold;">Votre nouveau mot de passe</label>
            <input type="password" name="nouveauMdp" placeholder="*******">
            <br><br>
            <button type="submit" class="btn bg-purple size2 white" name="modifierMdp">Modifier</button>
        </form>
    </div>
    
    <div id="modifierProfil">
    <h1 class="size5 bold spacebottom1" style="text-align: center;margin-top: 1%;">Modification de profil</h1>
        <h2 style="color:red; text-align: center;"><?=$error?></h2>
        <form  method="post" style="margin: auto;" enctype="multipart/form-data">

            <label style="font-size: 20px; font-weight: bold;">Votre nom</label>
            <input type="text" name="nom" placeholder="Nom" value="<?=$sportif['nom']?>">
            <br><br>

            <label style="font-size: 20px; font-weight: bold;">Votre prénom</label>
            <input type="text" name="prenom" placeholder="Prénom" value="<?=$sportif['prenom']?>">
            <br><br>

            <label style="font-size: 20px; font-weight: bold;">Votre email</label>
            <input type="email" name="email" placeholder="drafteam@mail.com" value="<?=$sportif['email']?>">
            <br><br>
            <?php
            if(!isset($_SESSION['entraineur']))
            {
            ?>
                <label style="font-size: 20px; font-weight: bold;">Numéro de maillot</label>
                <input type="number" name="numeroTel"  max="99" min="1">
                <br><br>
            <?php
            }
            ?>

            <label style="font-size: 20px; font-weight: bold;">Numéro de téléphone</label>
                <input type="number" name="numeroTel" placeholder="079 123 45 67" value="<?=$sportif['telephone']?>">
                <br><br>
                

            <label style="font-size: 20px; font-weight: bold;">Votre date de naissance</label>
            <input id="date" type="date" name="dateNaissance" value="<?=$sportif['dateNaissance']?>">
            <br><br>

            


            <label style="font-size: 20px">Modifiez votre photo de profil</label>
            <input type="file" name="profil" accept="image/png, image/jpeg, image/jpg" id="outputPhotoProfil"
                onchange="LoadPhotoProfil(event)">
            <div id="imgUploadPhotoProfil"
                style="width: 5vw;height: 5vw; background-size: cover;background-position: center; border-radius: 100%;">
            </div>
            <label style="font-size: 20px">Modifiez votre bannière</label>
            <input type="file" name="baniere" accept="image/png, image/jpeg, image/jpg" id="outputBanniere"
                onchange="LoadBanniere(event)">
            <div id="imgUploadBanniere" alt="" style="width: 20vw;height: 7vw;">
                <br>
            </div>
            <br>
            
            <button type="submit" class="btn bg-purple size2 white" name="modifierProfil">Modifier</button>
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
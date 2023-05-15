<!-- /**
 * Auteur: Gabriel Martin
 * Date: 04.05.2023
 * Description: Page pour la vue de la création d'un sportif
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
        <h1 class="size5 bold spacebottom1" style="text-align: center;margin-top: 10%;">Création de compte sportif</h1>
        <h2 style="color:red; text-align: center;"><?=$error?></h2>
        <form  method="post" style="margin: auto;" enctype="multipart/form-data">

            <label style="font-size: 20px; font-weight: bold;">Email</label>
            <input type="text" name="email" placeholder="drafteam@mail.com">
            <br><br>

            <label style="font-size: 20px; font-weight: bold;">Mot de passe <button type="button" onclick="copyPassword()">Copier</button>  </label>
            <div style="display: flex; align-items: center;">
                <input type="password" name="mdp" id="mdp" value="<?=$mdpGenerer?>" style="flex: 1;">
                <button type="button" class="bg-purple" onclick="togglePassword()" style="margin-left:-63px; height:64px; border-radius:10px; background-color:white;"><img id="eye-icon"src="./assets/img/oeil.png" style="height:100%;" alt=""></button>
            </div>
            <br><br>
            <label style="font-size: 20px; font-weight: bold;">Rôle</label>
            <select name="poste" style="border-radius: 8px;">
            <?php
            foreach ($postes as $poste) {
                ?>
                <option style="color: black;" value="<?=$poste['idPoste'];?>"><?=$poste['poste']?></option>
                <?php
            }
            ?>
                
            </select>

            <br><br>

            
            <button type="submit" class="btn bg-purple size2 white" name="inscription">Créer sportif</button>
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
    <script>
        function copyPassword() {
        var passwordField = document.getElementById("mdp");
        var password = passwordField.value;

        // Créer un élément temporaire pour la copie du texte
        var tempInput = document.createElement("input");
        tempInput.value = password;
        document.body.appendChild(tempInput);

        // Sélectionner le contenu de l'élément temporaire
        tempInput.select();
        tempInput.setSelectionRange(0, 99999);

        // Copier le contenu dans le presse-papier
        document.execCommand("copy");

        // Supprimer l'élément temporaire
        document.body.removeChild(tempInput);

        // Changer le texte du bouton après la copie
        var button = document.getElementsByTagName("button")[1];
        button.innerHTML = "Copié";

        // Réinitialiser le bouton après 2 secondes
        setTimeout(function() {
            button.innerHTML = "Copier";
        }, 2000);
    }
    </script>
    <!-- custom js file link -->
    <script src="./assets/js/togglePassword.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/affichage.js"></script>


</body>

</html>
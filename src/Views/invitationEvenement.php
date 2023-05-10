<?php
use drafteam\Models\PosteModel;
?>

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
    
   

    <div id="creationProfil" style="width: 100%;">
    <?php
    if($poste == "Joueurs")
    {
        echo "<img src=\"./assets/img/milieu@3x.png\" style=\"width:25%; margin-left:36%; margin-top:7%; \"alt=\"\">";
    }
    else{
        echo "<img src=\"./assets/img/entrainement2@3x.png\" style=\"width:25%; margin-left:36%; margin-top:7%; \"alt=\"\">";
    }
    
    ?>
    <?php 
    if($mesJoueurs != [])
    {
        ?>
                <h1 style="text-align:center; font-size:400%;"><?=$poste?></h1>
                <br>
                <form method="post" style="margin-left: 38%; width:100%;">
                    <ul style="display: inline-flex; list-style: none; width: 100%;" >
                        <li style="width: 35%;">
                            <button type="submit" class="btn bg-purple size2 white" style="margin-left:0%; width:100%;" name="inviter">Inviter</button>
                        </li>
                        <li style="margin-left: 0%; width: 40%;">
                            <button type="button" id="btn-toggle" onclick="toggleCheckboxes()" class="btn bg-purple size2 white" style="margin-left:62%; width:100%;">Tout cocher</button>
                        </li>
                    </ul>
                
                <br>
                <br>
                <?php
                foreach ($mesJoueurs as $joueur)
                {
                    
                ?>
                    <div class="container spacer5 ta-center bg-purple" style=" margin: 0%;background-image: url('./assets/<?php if($joueur['baniere'] == null){echo "img/fondBlanc.png";}else{echo "image/".$joueur['baniere'];} ?>'); width: 100%; background-size: cover;">
                    
                        <ul style="display: inline-flex; list-style: none; width:100%;">
                            <li style="width:40%; margin-top: 1%;"><img style="width:50%; height :100%;" class="photoProfil " src="./assets/<?php if($joueur['photo'] == null){echo "img/profileIcon.png";}else{echo "image/".$joueur['photo'];} ?>"></li>
                            <li style="width:45%; margin-left: 0%; margin-top: 2%; margin-right:12%;"><h4  style="font-size: 120%;text-align: center; color:black; border-radius: 8px; background-color:white; width:100%; height:95%;;"><?php if($joueur['prenom'] == null){echo $joueur['email'];}else{echo $joueur['prenom']."<br>".$joueur['nom']; }?><br><?php echo PosteModel::selectPosteById($joueur['idPoste'])['poste'];?></h4></li>
                            <?php
                            if(isset($_SESSION['entraineur']) == true)
                            {
                            ?>
                                <div class="text-center" style="margin-top:2%;"> <input type="checkbox" id="horns" name="invitation<?=$joueur['idSportif']?>">
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
            </form>

            <?php 
    } else{
        echo "<h1 style=\"text-align:center; font-size:400%;\">Tous les joueurs sont déjà invités</h1>";
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
    <script>
        function toggleCheckboxes() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = !checkboxes[i].checked;
        }
        var btnToggle = document.getElementById('btn-toggle');
        if (btnToggle.innerHTML === 'Tout cocher') {
            btnToggle.innerHTML = 'Tout décocher';
        } else {
            btnToggle.innerHTML = 'Tout cocher';
        }
        }
    </script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/affichage.js"></script>


</body>

</html>
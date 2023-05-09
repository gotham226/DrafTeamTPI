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
    
    <div style="width:100%; margin-top: 8%;" >
        <h1 class="size5 bold spacebottom1" style="text-align: center;margin-top: 8%;"><?=$evenement['nomEvenement']?></h1>

        

        <?php
                if(isset($_SESSION['entraineur']) == true)
                {
                ?>
                <div style="text-align:center;"> <a href="modifierEvenement?idEvenement=<?=$_GET['idEvenement']?>" style="color: white;"> <button  style=" color: blue; background-color: #0a78df00; border: none;" class="material-icons button edit">edit</button> </a>
                    <a href="deleteEvenement?idEvenement=<?=$_GET['idEvenement']?>"> <button  style=" color: red; background-color: #0a78df00; border: none;"  class="material-icons button delete">delete</button> </a>
                    </div>
                    
                    <?php 
                    if($evenement['image'] != null && $evenement['image'] != '')
                    { 
                    ?>
                        <img src="./assets/image/<?=$evenement['image']?>" style="width:30%; margin-left:35%;" alt="">
                    <?php
                    }else{
                    ?>
                        <div id="dropzone" style="border: 2px dashed gray;  margin: auto; text-align: center; padding: 2%; width:50%; margin-left: 25%; margin-top: 2%;">
                            <p id="filename" style="font-size: 200%;">Faites glisser une image ici ou cliquez pour choisir votre image</p>
                        </div>
                        <form id="upload-form" method="post" enctype="multipart/form-data" style="margin: auto;">
                            <input type="file" name="image" id="image" style="display: none;">
                            <button type="submit" id="upload-button" class="btn bg-purple size2 white" name="ajoutImage" disabled>Ajouter l'image</button>
                        </form>
                    <?php
                    }

                }else{
                    if($evenement['image'] != null && $evenement['image'] != '')
                    { 
                    ?>
                        <img src="./assets/image/<?=$evenement['image']?>" style="width:30%; margin-left:35%;" alt="">
                    <?php
                    }
                }
                ?>

        <ul style="display: inline-flex; list-style: none; width: 100%; margin-top: 3%; ">

            <li style="width:20%; margin-left:20%; font-size:20px;">
                <img src="./assets/img/match1@3x.png" style="width:100%; "alt="">
                <h1 style="text-align:center;">Informations</h1>
                <br>
                
                <br>
                <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 95%;">
                    <ul style="width: 100%;display: -webkit-box;align-items: flex-start;height: 95%;list-style:none; margin-left:1%; ">
                        <li style=" border-right: 2px solid #544f61;width:30%; margin-top:4%; margin-bottom: 4%; font-size:70%;"><h3>Heure</h3> <p style="margin-top: 10%;"><?php echo  date("H\hi", strtotime($evenement['heureDebut'])); ?> </p></li>
                        <li style="width:69%; margin-top:1.5%; margin-bottom: 4%;">
                            <ul style="list-style:none; font-size:75%; color:black;" >
                                <li>Durée : <?=$duree?></li>
                                <li>Adresse : <?=$adresse?></li>
                                <li>Type : <?=$type?></li>
                            </ul>
                        </li>
                    </ul>
                                        
                </div>
            </li>

            <li style="width:20%; font-size:20px;">
                <img src="./assets/img/milieu@3x.png" style="width:100%; "alt="">
                <h1 style="text-align:center;">Joueurs invités</h1>
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

                foreach ($joueursInviter as $joueur)
                {
                    
                ?>
                    <div class="container spacer5 ta-center bg-purple" style="background-image: url('./assets/<?php if($joueur['baniere'] == null){echo "img/fondBlanc.png";}else{echo "image/".$joueur['baniere'];} ?>'); width: 70%; background-size: cover;">
                    
                        <ul style="display: inline-flex; list-style: none; width:100%;height:100%;">
                            <li style="width:40%; margin-top: 2%;"><img style="width: 75%; height:96%; " class="photoProfil " src="./assets/<?php if($joueur['photo'] == null){echo "img/profileIcon.png";}else{echo "image/".$joueur['photo'];} ?>"></li>
                            <li style="width:45%; margin-left: 2%; margin-top: 2%; margin-right:12%;"><h4  style="font-size: 75%;text-align: center;border-radius: 8px; background-color:#6f5aad; width:100%; color: white;"><?php if($joueur['prenom'] == null){echo $joueur['email'];}else{echo $joueur['prenom']."<br>".$joueur['nom']; }?><br><?php echo PosteModel::selectPosteById($joueur['idPoste'])['poste'];?></h4></li>
                            <?php
                            if(isset($_SESSION['entraineur']) == true)
                            {
                            ?>
                                
                                
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
                <h1 style="text-align:center;">Staff invités</h1>
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
                <br>
                <?php
                }
                foreach ($monStaffInviter as $staff)
                {
                    
                ?>
                    <div class="container spacer5 ta-center bg-purple" style="background-image: url('./assets/<?php if($staff['baniere'] == null){echo "img/fondBlanc.png";}else{echo "image/".$staff['baniere'];} ?>'); width: 70%; background-size: cover;">
                    
                        <ul style="display: inline-flex; list-style: none; width:100%;height:100%;">
                            <li style="width:40%; margin-top: 2%;"><img style="width: 75%; height:96%; " class="photoProfil " src="./assets/<?php if($staff['photo'] == null){echo "img/profileIcon.png";}else{echo "image/".$staff['photo'];} ?>"></li>
                            <li style="width:55%; margin-left: 10%; margin-top: 2%; margin-right:5%;"><h4  style="font-size: 80%;text-align: center; color:white; border-radius: 8px; background-color:#6f5aad;"><?php if($staff['prenom'] == null){echo $staff['email'];}else{echo $staff['prenom']."<br>".$staff['nom']; }?><br><?php echo PosteModel::selectPosteById($staff['idPoste'])['poste'];?></h4></li>
                            <?php
                            if(isset($_SESSION['entraineur']) == true)
                            {
                            ?>
                                
                                
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


    

    <script>
        let dropzone = document.getElementById("dropzone");
        let uploadButton = document.getElementById("upload-button");
        let filename = document.getElementById("filename");
        let input = document.getElementById("image");

        // Ouvrir la fenêtre de sélection de fichiers en cliquant sur le dropzone
        dropzone.addEventListener("click", function() {
            input.click();
        });

        // Empêcher le comportement par défaut du navigateur lorsqu'on dépose un fichier
        dropzone.addEventListener("dragover", function(event) {
            event.preventDefault();
            dropzone.style.backgroundColor = "lightgray";
        });

        dropzone.addEventListener("dragleave", function(event) {
            event.preventDefault();
            dropzone.style.backgroundColor = "";
        });

        // Gérer la sélection de fichiers
        input.addEventListener("change", function() {
            let file = input.files[0];
            if(file && file.type.match(/image.*/)) {
                // Ajouter le code pour traiter l'image ici
                filename.innerText = file.name;
                uploadButton.disabled = false;
            }
        });

        // Gérer le dépôt de fichiers
        dropzone.addEventListener("drop", function(event) {
            event.preventDefault();
            dropzone.style.backgroundColor = "";
            let files = event.dataTransfer.files;
            for(let i = 0; i < files.length; i++) {
                let file = files[i];
                if(file.type.match(/image.*/)) {
                    // Ajouter le code pour traiter l'image ici
                    filename.innerText = file.name;
                    input.files = files;
                    uploadButton.disabled = false;
                }
            }
        });

        // Gérer le clic sur le bouton d'upload
        uploadButton.addEventListener("click", function(event) {
            event.preventDefault();
            document.getElementById("upload-form").submit();
        });
    </script>
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
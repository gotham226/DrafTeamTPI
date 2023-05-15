<?php
/**
 * Auteur: Gabriel Martin
 * Date: 09.05.2023
 * Description: Page pour la vue des événements
 * Version 1.0
 */
use drafteam\Models\PosteModel;
use drafteam\Models\EventModel;
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
    <?php
    if($invited && $evenement['heureFin'] > date('Y-m-d H:i:s'))
    {
        if($infoParticipation['present'] == 1)
        {
        ?>
            <form method="POST" style="margin: auto; padding: 0%;">
            <a href="/justification?idEvenement=<?=$_GET['idEvenement']?>"><button type="button" class="btn size2 white" name="mettreAbsent" style="background: linear-gradient(214.02deg, #d8f9c7 6.04%, #56ff50 92.95%); color: black; width:100%;"><strong>Présent</strong> <i class="fa fa-check" style="margin-right: 5px;"></i> </button></a>
            </form>
        <?php
        }else if($infoParticipation['present'] == ""){
        ?>
            <form method="POST" style="margin: auto; padding: 0%;">
                <ul style="display: inline-flex; list-style:none;">
                    <li>
                        <button type="submit" class="btn size2 white" name="present" style="border: 1px solid #d8f9c7;background-color: transparent; color: #d8f9c7;"><strong>Présent</strong> </button>
                    </li>

                    <li style="margin-left: 65%;">
                        <a href="/justification?idEvenement=<?=$_GET['idEvenement']?>"><button type="button" class="btn size2 white" name="absent" style=" border: 1px solid #f49494; background-color: transparent; color: #f49494;"><strong>Absent</strong> </button></a>
                    </li>

                </ul>
            </form>
            <?php
        }else if($infoParticipation['present'] == 0){
        ?>
            <form method="POST" style="margin: auto; padding: 0%;">
                <button type="submit" class="btn size2 white" name="present" style="border: 1px solid #f49494; background: linear-gradient(214.02deg, #f49494 6.04%, #fb2525 92.95%); color: black;"><strong>Absent</strong></button>
            </form>
        <?php
        }
    }
    ?>
        <h1 class="size5 bold spacebottom1" style="text-align: center;margin-top: 2%;"><?=$evenement['nomEvenement']?></h1>

        

        <?php
                if(isset($_SESSION['entraineur']) == true)
                {
                ?>
                <div style="text-align:center; margin-bottom:2%;" > <a href="modifierEvenement?idEvenement=<?=$_GET['idEvenement']?>" style="color: white;"> <button  style=" color: blue; background-color: #0a78df00; border: none;" class="material-icons button edit">edit</button> </a>
                    <a href="deleteEvenement?idEvenement=<?=$_GET['idEvenement']?>"> <button  style=" color: red; background-color: #0a78df00; border: none;"  class="material-icons button delete">delete</button> </a>
                    </div>

                    <?php 
                    if($evenement['heureFin'] < date('Y-m-d H:i:s') && $type == "Match")
                    {
                        if($evenement['resultat'] === null)
                        {
                            ?>
                                <h1 class="size3 bold" style="text-align: center;margin-top: 2%;">Score du match :</h1>
                                    <h1 class="size2 bold" style="text-align: center;margin-top: 2%; color:red;"><?=$error?></h1>
                                    <form method="post" style="margin-left:35%;">
                                        <ul style="display: inline-flex; list-style:none;">
                                            <li style="margin-right:4%;">
                                                <label class="size2" >Domicile</label>
                                                <input type="number" name="domicile" id="">
                                            </li>

                                            <li style="margin-top:12%;  margin-right:4%;">
                                                <h1 class="size4 bold spacebottom1" style="text-align: center;margin-top: 2%;">-</h1>
                                            </li>

                                            <li>
                                                <label class="size2">Visiteur</label>
                                                <input type="number" name="exterieur" id="">
                                            </li>
                                        </ul>
                                        <button type="submit" name="validerEnregistrer"style="margin-left:40%;" class="btn bg-purple wallet">Valider</button> 
                                    </form>
                            <?php
                        }else{
                            echo "<h1 class=\"size2 bold\" style=\"text-align: center;margin-top: 2%; \">Score du match: <br>".$evenement['resultat']."</h1>";
                            ?>
                                <div style="text-align:center; margin-bottom:2%;"> <a href="modifierScore?idEvenement=<?=$_GET['idEvenement']?>" style="color: white;"> <button  style=" color: blue; background-color: #0a78df00; border: none;" class="material-icons button edit">edit</button> </a>
                                </div>
                            <?php
                        }
                    
                    }

                    if($evenement['image'] != null && $evenement['image'] != '')
                    { 
                    ?>
                        <img src="./assets/image/<?=$evenement['image']?>" style="width:30%; margin-left:35%;" alt="">
                        
                            <div style="margin-left:38.3%; margin-top: 1%;">
                            <form method="post">
                                <button type="submit" name="deleteImg" style=" color: red; background-color: #0a78df00; border: none;" class="material-icons button delete">delete</button>
                            </form>
                            </div>
                            
                    <?php
                    }else{
                    ?>
                        <div id="dropzone" style="border: 2px dashed gray;  margin: auto; text-align: center; padding: 2%; width:50%; margin-left: 25%; margin-top: 2%;">
                            <p id="filename" style="font-size: 200%;">Faites glisser une image ici ou cliquez pour choisir votre image</p>
                        </div>
                        <form id="upload-form" method="post" enctype="multipart/form-data" style="margin: auto;">
                            <input type="file" name="image" id="image" style="display: none;">
                            <button type="submit" id="upload-button" class="btn bg-purple size2 white" name="ajoutImage" disabled>Ajouter l'image</button>
                            <br>
                            <a class="size2"href="https://www.demivolee.com/creez-votre-compo/outil-de-creation-de-composition-dequipe/" style="color: grey;">Cliquez ici pour faire ses propres compos ! </a>
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
                    <a href="/invitation?idEvenement=<?=$_GET['idEvenement']?>&poste=joueur">
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
                            <li style="width:35%; margin-top: 2%;"><img style="width: 75%; height:96%; " class="photoProfil " src="./assets/<?php if($joueur['photo'] == null){echo "img/profileIcon.png";}else{echo "image/".$joueur['photo'];} ?>"></li>
                            <li style="width:40%; margin-left: 2%; margin-top: 2%; margin-right:12%;"><h4  style="font-size: 75%;text-align: center;border-radius: 8px; background-color:white; width:100%; color: black;"><?php if($joueur['prenom'] == null){echo explode("@", $joueur['email'])[0];}else{echo $joueur['prenom']."<br>".$joueur['nom']; }?><br><?php echo PosteModel::selectPosteById($joueur['idPoste'])['poste'];?></h4></li>
                            <?php
                            if(isset($_SESSION['entraineur']) == true)
                            {
                                $infoJoueurInviter = EventModel::checkIfImInvited($joueur['idSportif'], $_GET['idEvenement']);
                                
                                if($infoJoueurInviter['present'] === 1)
                                {
                            ?>
                                <li style=" margin-top:10%;"><i class="fa fa-check" style="color: #90EE90; font-size: 150%;"></i></li>
                                
                                
                            <?php
                                }else if($infoJoueurInviter['present'] === 0){
                                    
                                ?>

                                    <li style=" margin-top:8%;"><i class="fa fa-times" style="color: red; font-size: 150%;"></i> <br><a href="/affichageCommentaire?commentaire=<?=$infoJoueurInviter['commentaire']?>" ><i class="fa fa-comment" style="color:red;"></i></a></li>
                                    
                                    
                                <?php  
                                }else{
                                    ?>

                                    <li style=" margin-top:10%;"><i class="fa fa-clock" style="color: orange; font-size: 150%;"></i></li>
                                    
                                <?php  
                                }
                            }
                            ?>
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
                <h1 style="text-align:center;">Staffs invités</h1>
                <br>
                <br>
                <?php
                if(isset($_SESSION['entraineur']))
                {
                ?>
                    <a href="/invitation?idEvenement=<?=$_GET['idEvenement']?>&poste=staff">
                        <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 70%; background-size: cover;">
                            
                            <h2 style="text-align: center;font-size: 90px;color: white;">+</h2>
                            
                        </div>
                    </a>
                    
                    <br>
                <?php
                }
                foreach ($monStaffInviter as $staff)
                {
                    
                ?>
                    <div class="container spacer5 ta-center bg-purple" style="background-image: url('./assets/<?php if($staff['baniere'] == null){echo "img/fondBlanc.png";}else{echo "image/".$staff['baniere'];} ?>'); width: 70%; background-size: cover;">
                    
                        <ul style="display: inline-flex; list-style: none; width:100%;height:100%;">
                            <li style="width:35%; margin-top: 2%;"><img style="width: 75%; height:96%; " class="photoProfil " src="./assets/<?php if($staff['photo'] == null){echo "img/profileIcon.png";}else{echo "image/".$staff['photo'];} ?>"></li>
                            <li style="width:40%; margin-left: 2%; margin-top: 2%; margin-right:12%;"><h4  style="font-size: 80%;text-align: center; color:black; border-radius: 8px; background-color:white;"><?php if($staff['prenom'] == null){echo explode("@", $staff['email'])[0] ;}else{echo $staff['prenom']."<br>".$staff['nom']; }?><br><?php echo PosteModel::selectPosteById($staff['idPoste'])['poste'];?></h4></li>
                            <?php
                            if(isset($_SESSION['entraineur']) == true)
                            {
                                $infoStaffInviter = EventModel::checkIfImInvited($staff['idSportif'], $_GET['idEvenement']);
                                if($infoStaffInviter['present'] === 1)
                                {
                            ?>
                                <li style=" margin-top:10%;"><i class="fa fa-check" style="color: #90EE90; font-size: 150%;"></i></li>
                                
                            <?php
                                }else if($infoStaffInviter['present'] === 0){
                                ?>

                                    <li style=" margin-top:3%;margin-bottom:6%; border-radius: 8px;"><i class="fa fa-times" style="color: red; font-size: 150%;"></i> <br><a href="/affichageCommentaire?commentaire=<?=$infoStaffInviter['commentaire']?>" ><i class="fa fa-comment" style="color:red;"></i></a></li>
                                    
                                    
                                <?php  
                                }else{
                                    ?>
                                    <li style=" margin-top:10%;"><i class="fa fa-clock" style="color: orange; font-size: 150%;"></i></li>
                                    
                                    
                                <?php  
                                }
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


    
    <script src="./assets/js/dragAndDrop.js"></script>    
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
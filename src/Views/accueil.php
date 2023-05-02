<!-- Lien template de base : https://github.com/dzarrorn/NFTwebsite_html-sass -->
<?php



?>
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
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>Draft Team</title>
</head>

<body onload="GetWindowHeight();" id="collections" onresize="GetWindowHeight()">
    <!-- header section Début -->
    
    
    <header class="header bg-white10 shadow">
        <?php
        require_once('inc/nav.php');
        ?>

    </header>

    <div id="pageAccueil">
        <?php
            if(isset($_SESSION['entraineur']) == true ){
        ?>
        <div id="btnCreation" style="display: flex;justify-content: space-around;width: 100%;z-index: 200000;position: absolute;align-items: flex-end; ">
            <button id="newEvent" name="collections" class="btn bg-purple" style="position: fixed;z-index: 100000;"
            onclick = "location.href='/createEvent'" onmouseover="TestBouton()" onmouseout="ChangeTextIn()">+</button> 
        </div>
        <?php
            }
        ?>
        <!-- Titre+Logo -->
        <div id="TitrePrincipal">
            <img src="./assets/img/LogoNormal.png" alt="logo" id="LogoPrincipal">

        </div>
        
       <section>
            <h1 style="margin-top:5%;"class="bold size4 ta-center">Créer ton équipe coach !</h1>
            <h1 style=" margin-top:1%;" class="spacebottom3 halfwhite size2 ta-center"> Rejoins ou crée un championnat pour pouvoir créer ton équipe</h1>
            <img src="./assets/img/icone_coach@3x.png" style="width:10%; margin-left:45%;"alt="">
            <br>
            <button style="width:20%; margin-left: 40%;margin-top:2%;" onclick="location.href='/creationChampionnat'"  class="btn bg-purple wallet">Créer un championnat</button>
            <button style="width:20%; margin-left: 40%;margin-top:1%;" onclick="location.href='/creationEquipe'"  class="btn bg-purple wallet">Créer une équipe</button>
       </section>

        
        <!-- Evenement a venir -->
        <?php
            if(isset($_SESSION['email']) != "" ){
                ?>  
                    <section class="collections spacer10" id="event">
                        <div class="container">
                            <h1 class="bold size4 ta-center">Évenements</h1>
                            <p class="spacebottom3 halfwhite size2 ta-center">
                                Les évenements à venir dans les prochains jours
                            </p>
                            
                            <div class="row box-card jc-evenly-md " style="display: flex; flex-wrap: wrap;">
                                <section class="example" style="margin-left: 25%; width: 50%; height: 20rem; background-color: rgba(238, 238, 238, 0); box-shadow: inset 0 0.5rem 1rem rgba(0, 0, 0, 0.4);">
                                    <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 95%;">
                                        <ul style="width: 100%;display: -webkit-box;align-items: flex-start;height: 95%;list-style:none; margin-left:1%; ">
                                            <li style=" border-right: 2px solid #544f61;width:30%; margin-top:4%; margin-bottom: 4%;"><h3>Heure du match:</h3> <p>20h</p></li>
                                            <li style="width:69%; margin-top:4%; margin-bottom: 4%;">1</li>
                                        </ul>
                                        
                                    </div>
                                    <br></br>
                                    <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 95%;">
                                        <ul style="width: 100%;display: -webkit-box;align-items: flex-start;height: 95%;list-style:none; margin-left:1%; ">
                                            <li style=" border-right: 2px solid #544f61;width:30%; margin-top:4%; margin-bottom: 4%;"><h3>Heure du match:</h3> <p>20h</p></li>
                                            <li style="width:69%; margin-top:4%; margin-bottom: 4%;">1</li>
                                        </ul>
                                        
                                    </div>
                                    <br></br>
                                    <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 95%;">
                                        <ul style="width: 100%;display: -webkit-box;align-items: flex-start;height: 95%;list-style:none; margin-left:1%; ">
                                            <li style=" border-right: 2px solid #544f61;width:30%; margin-top:4%; margin-bottom: 4%;"><h3>Heure du match:</h3> <p>20h</p></li>
                                            <li style="width:69%; margin-top:4%; margin-bottom: 4%;">1</li>
                                        </ul>
                                        
                                    </div>
                                    <br></br>
                                    <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 95%;">
                                        <ul style="width: 100%;display: -webkit-box;align-items: flex-start;height: 95%;list-style:none; margin-left:1%; ">
                                            <li style=" border-right: 2px solid #544f61;width:30%; margin-top:4%; margin-bottom: 4%;"><h3>Heure du match:</h3> <p>20h</p></li>
                                            <li style="width:69%; margin-top:4%; margin-bottom: 4%;">1</li>
                                        </ul>
                                        
                                    </div>
                                    <br></br>
                                    <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 95%;">
                                        <ul style="width: 100%;display: -webkit-box;align-items: flex-start;height: 95%;list-style:none; margin-left:1%; ">
                                            <li style=" border-right: 2px solid #544f61;width:30%; margin-top:4%; margin-bottom: 4%;"><h3>Heure du match:</h3> <p>20h</p></li>
                                            <li style="width:69%; margin-top:4%; margin-bottom: 4%;">1</li>
                                        </ul>
                                        
                                    </div>
                                </section>
                            </div>
                        </div>
                    </section>
                <?php
            }else{
                ?>
                
                <h1 style="margin-top:5%;" class="bold size4 ta-center">Bienvenue sur DrafTeam !</h1>

                    <ul style="margin-left:35%; list-style:none; display: inline-flex; width:60%; margin-top:5%;">
                        <li style="width:25%;"><h1 style=" margin-top:1%;" class="spacebottom3 halfwhite size2 ta-center">Tu es joueur ou staff ? <br> Connectes-toi avec les informations que ton entraîneur t'a transmis.</h1></li>
                        <li style="width:25%;"><h1 style=" margin-top:1%;" class="spacebottom3 halfwhite size2 ta-center">Tu es entraîneur et tu souhaites créer une équipe ? <br>Inscrit-toi en tant qu'entraîneur.</h1></li>
                    </ul>

                    <ul style="margin-left:38%; list-style:none; display: inline-flex; margin-top:2%;width:61%;">
                        <li style="width:25%;"><button style="width:50%;" onclick="location.href='/connexion'"  class="btn bg-purple wallet">Se connecter</button> </li>
                        <li style="width:25%;"><button style="width:50%;" onclick="location.href='/inscription'"  class="btn bg-purple wallet">S'inscrire</button> </li>
                    </ul>
                <?php
            }
        ?>
        


        <?php
        if(isset($_SESSION['email']) != "" ){

        
        
        ?>
        <!-- Carousel Equipe -->
        <section class="creator spacer10" id="featured">
        <div class="container">
            <h1 class="bold size4 ta-center">Equipe</h1>
            <p class="spacebottom3 halfwhite size2 ta-center">
                Lorem ipsum dolor sit amet, consectetur<br>adipiscing elit.
            </p>
            <div class="swiper row creator-slider">
                <div class="swiper-wrapper">
                    <div class="col4 col5-md col7-s swiper-slide">
                    <div class="card-creator bg-white10 ta-center">
                            <img src="./assets/img/graphisteCodeur.png" class="img-responsive" alt="">
                            <img src="./assets/img/lael.jpg" class="photo" alt="">
                            <h5 class="spacer1 size2 bold">Laël Umutsinzi</h5>
                            <p class="spacebottom2 halfwhite desc">Étudiant au<br> CFPT Informatique
                            </p>
                        </div>
                    </div>
                    <div class="col4 col5-md col7-s swiper-slide">
                    <div class="card-creator bg-white10 ta-center">
                            <img src="./assets/img/backGab.png" class="img-responsive" alt="">
                            <img src="./assets/img/Andreas.jpg" class="photo" alt="">
                            <h5 class="spacer1 size2 bold">Andreas Khmelnitski</h5>
                            <p class="spacebottom2 halfwhite desc">Étudiant au<br> CFPT Informatique
                            </p>

                        </div>
                    </div>
                    <div class="col4 col5-md col7-s swiper-slide">
                    <div class="card-creator bg-white10 ta-center">
                            <img src="./assets/img/backGab.png" class="img-responsive" alt="">
                            <img src="./assets/img/GAB.jpg" class="photo" alt="">
                            <h5 class="spacer1 size2 bold">Gabriel Martin</h5>
                            <p class="spacebottom2 halfwhite desc">Étudiant au<br> CFPT Informatique
                            </p>

                        </div>
                    </div>
                    <div class="col4 col5-md col7-s swiper-slide">
                    <div class="card-creator bg-white10 ta-center">
                            <img src="./assets/img/graphisteCodeur.png" class="img-responsive" alt="">
                            <img src="./assets/img/moi.jpg" class="photo" alt="">
                            <h5 class="spacer1 size2 bold">Sergio Catalan</h5>
                            <p class="spacebottom2 halfwhite desc">Étudiant au<br> CFPT Informatique
                            </p>
 
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Fin Carousel Equipe -->
   
    
    <!-- Page profil -->
    <div id="pageProfil" style="text-align: center; margin-top:10%;">
        
        <div style="margin-bottom: 109px;">
                <?php
                    if(isset($_SESSION['photoBaniere']) !=""){
                    ?>
                        <div class="banniere" alt="ht " style="background-image: url('./assets/image/<?=$_SESSION['photoBaniere']?>');"id="banniereUtil"> </div>
                    <?php
                    }else{
                    ?>
                        <div class="banniere" alt="ht " id="banniereUtil"> </div>
                    <?php
                    }
                ?>
            

            <div class="infoProfil ">
                <?php
                    if(isset($_SESSION['photoProfil']) !=""){
                    ?>
                        <img id="ppUtil" class="photoProfil " src="./assets/image/<?=$_SESSION['photoProfil']?>">
                    <?php
                    }else{
                    ?>
                        <img id="ppUtil" class="photoProfil " src="./assets/img/profileIcon.png">
                    <?php
                    }
                ?>
                
                <h2 id="nomUtilisateurProfil">Nom de l'utilisateur</h2>
                
                <p class="editeProfile"><a style="color: white;"href="/modifierProfil"> Éditer le profil</a></p>
            </div>

        </div>

    </div>
    <!-- Fin Page profil -->

    <?php
        }else{
            ?>

            <?php
        }
    ?>    

   
    <!-- footer section -->
    <footer class="spacer10">
        <div class="container row jc-between flexcol-s ta-center-s ">
            <div class="row flexcol spacebottom3-s spaceleft3-s">
                
            </div>
        </div>
    </footer>
    <!-- Fin footer section ends -->

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- custom js file link -->
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/affichage.js"></script>


</body>

</html>
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
    

    <div id="pageProfil" style="text-align: center;margin-top:3%;">
        
        <div style="margin-bottom: 109px;">
            <div style="width: 100%; background-image: url('./assets/img/backGroundBaniereLogo-flou.jpg');"class="banniere" alt="ht " id="banniereUtil"> </div>
            

            <div class="infoProfil" >
                        <img id="ppUtil" class="photoProfil " src="./assets/image/<?=$monEquipe['ecusson']?>">

                
                <h1 style="font-size:80px;"><?=$monEquipe['nomEquipe']?></h1>

                <?php
                if(isset($_SESSION['entraineur']) == true)
                {
                ?>
                    <div class="text-center"> <a href="modifierEquipe?idEquipe=<?=$_SESSION['idEquipe']?>" style="color: white;"> <button  style=" color: blue; background-color: #0a78df00; border: none;" class="material-icons button edit">edit</button> </a>
                    <a href="deleteEquipe?idEquipe=<?=$_SESSION['idEquipe']?>"> <button  style=" color: red; background-color: #0a78df00; border: none;"  class="material-icons button delete">delete</button> </a>
                    </div>
                    
                <?php
                }
                ?>
                
            </div>

        </div>

    </div>

    <br></br>

    <div style="width:100%; margin-top: 10%;" >
        <ul style="display: inline-flex; list-style: none; width: 100%;">

            <li style="width:20%; margin-left:28%; font-size:20px;">
                <h1>Entraineur</h1>
            </li>

            <li style="width:20%; font-size:20px;">
                <h1>Joueur</h1>
            </li>

            <li style="width:20%; font-size:20px;">
                <h1>Staff</h1>
            </li>

        </ul>

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
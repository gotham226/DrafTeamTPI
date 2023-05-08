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
        
        <h1 class="size5 bold spacebottom1" style="text-align: center;margin-top: 6%; margin-bottom: 3%;">Gestion championnats</h1>
        
        <?php if($idChampionnatActif != null){?>
            <h1 style=" margin-top:1%;" class="spacebottom3 halfwhite size2 ta-center">Championnat actif </h1>
            <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 20%;">
                    <br>
                    <br>
                    <?php
                    if(isset($_SESSION['entraineur']))
                    {
                        
                            
                        ?>

                            <ul style="display: inline-flex; list-style: none; width:100%; ">
                                <li style="margin-left: 5%;"><button  onclick="location.href='/desactiver?idChampionnatActif='$idChampionnatActif" style="color: black;" class="btn">Désactiver</button></li>
                                <a style="margin-left: 5%; color: white;" href="/infoChampionnat?idChampionnat=<?=$idChampionnatActif?>"><li ><h2 style="text-align: center;"><?php echo $championnatsActif['nomChampionnat']." ". $championnatsActif['saison']."/". $championnatsActif['saison']+1?></h2></li></a>
                            </ul>
                            <br>
                            <div class="text-center"> <a href="modifierChampionnat?idChampionnat=<?=$idChampionnatActif?>" style="color: white;"> <button  style=" color: blue; background-color: #0a78df00; border: none;" class="material-icons button edit">edit</button> </a>
                            <a href="deleteChampionnat?idChampionnat=<?=$idChampionnatActif?>"> <button  style=" color: red; background-color: #0a78df00; border: none;"  class="material-icons button delete">delete</button> </a>
                            
                            </div>
                        <?php
                        ?>
                            
                        <?php
                        }else{
                        ?>
                            <a style="margin-left: 11%; color: white;" href="/infoChampionnat?idChampionnat=<?=$idChampionnatActif?>"><h2 style="text-align: center;"><?php echo $championnatsActif['nomChampionnat']." ". $championnatsActif['saison']."/". $championnatsActif['saison']+1?></h2></a>
                        <?php
                        }
                        ?>
                    </div>
                    <br></br>
            
            </div>
            <br></br>
            <br></br>
        <?php
        }
        if(isset($_SESSION['entraineur']))
        {
        ?>
            <a href="/creationChampionnat">
                <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 20%;">
                    
                    <h2 style="text-align: center;font-size: 100px;color: white;">+</h2>
                    
                </div>
            </a>
        <?php
        }
        ?>
            <br></br>

        <?php
        foreach ($championnats as $championnat)
        {
            $idChampionnat = $championnat['idChampionnat'];
            $nomChampionnat = $championnat['nomChampionnat'];
            $saison = $championnat['saison']."/".$championnat['saison']+1;

            if($idChampionnatActif != $idChampionnat){
        ?>
            
            <div class="container spacer5 ta-center bg-purple" style="background-color: rgba(238, 238, 238, 0);box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.4);width: 20%;">
                <br>
                <br>
                <?php
                
                if(isset($_SESSION['entraineur']))
                {
                    if(isset($_SESSION['idEquipe'])!=null){
                        
                    ?>
                        <ul style="display: inline-flex; list-style: none; width:100%; ">
                            <li style="margin-left: 5%;"><button  onclick="location.href='/mettreActif?idChampionnat=<?=$idChampionnat?>'" style="color: black;" class="btn">Activer</button></li>
                            <a style="margin-left: 11%; color: white;" href="/infoChampionnat?idChampionnat=<?=$idChampionnat?>"><li ><h2 style="text-align: center;"><?php echo $nomChampionnat." ". $saison?></h2></li></a>
                        </ul>
                        <br>
                        <div class="text-center"> <a href="modifierChampionnat?idChampionnat=<?=$idChampionnat?>" style="color: white;"> <button  style=" color: blue; background-color: #0a78df00; border: none;" class="material-icons button edit">edit</button> </a>
                        <a href="deleteChampionnat?idChampionnat=<?=$idChampionnat?>"> <button  style=" color: red; background-color: #0a78df00; border: none;"  class="material-icons button delete">delete</button> </a>
                        
                        </div>
                    <?php
                    }else{
                        ?>
                        <a href="/infoChampionnat?idChampionnat=<?=$idChampionnat?>"><h2 style="text-align: center;"><?php echo $nomChampionnat." ". $saison?></h2></a>
                        <br>
                        <div class="text-center"> <a href="modifierChampionnat?idChampionnat=<?=$idChampionnat?>" style="color: white;"> <button  style=" color: blue; background-color: #0a78df00; border: none;" class="material-icons button edit">edit</button> </a>
                        <a href="deleteChampionnat?idChampionnat=<?=$idChampionnat?>"> <button  style=" color: red; background-color: #0a78df00; border: none;"  class="material-icons button delete">delete</button> </a>
                        
                        </div>

                    <?php
                    }
                    ?>
                        
                    <?php
                    }else{
                    ?>
                        <a href="/infoChampionnat?idChampionnat=<?=$idChampionnat?>"><h2 style="text-align: center;"><?php echo $nomChampionnat." ". $saison?></h2></a>
                    <?php
                    }
                    ?>
                </div>
                
                <br></br>

            <?php
                }   
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
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/affichage.js"></script>


</body>

</html>
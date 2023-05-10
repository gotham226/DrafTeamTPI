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

<body onload="GetWindowHeight();" id="collections" onresize="GetWindowHeight()">
    <!-- header section Début -->
    
    <a name="top"></a>
    <header class="header bg-white10 shadow">
        
    <?php
    require_once('inc/nav.php');
    ?>


    </header>


      <!-- header section Fin -->
   
        


    <div style="margin-top: 10%;">
        <h1 class="size5 bold spacebottom1" style="text-align: center;margin-top: 6%;">Créer votre <span
                class="lightpurple">évènement</span></h1>
                <h2 style="color:red; text-align: center;"><?=$error?></h2>
        <form  method="post" style="margin: auto;">

            <label style="font-size: 20px; font-weight: bold;">Nom de l'évènement</label>
            <input type="text" name="nomEvent" placeholder="Match">
            <br><br>

            <label style="font-size: 20px; font-weight: bold;">Description</label>
            <textarea name="description"  cols="30" rows="10" class="laDescription"></textarea>
            <br><br>
            
            <label style="font-size: 20px; font-weight: bold;">Début de l'évènement</label>
            <input type="datetime-local" name="debut" required>
            <br><br>

            <label style="font-size: 20px; font-weight: bold;">Fin de l'évènement</label>
            <input type="datetime-local" name="fin" required>
            <br><br>

            <label style="font-size: 20px; font-weight: bold;">Type d'évènement</label>
            <select name="type" style="border-radius: 8px;">
            <option style="color: black; text-align:center;" value="">--> Sélectionnez le type de l'évènement <--</option>
            <?php
            foreach ($types as $type) {
                ?>
                <option style="color: black;" value="<?=$type['idType'];?>"><?=$type['type']?></option>
                <?php
            }
            ?>
                
            </select>
            <br><br>

            <label style="font-size: 20px; font-weight: bold;">Lieu de l'évènements</label>
            <select name="lieu" style="border-radius: 8px;">
            <option style="color: black; text-align:center;" value="">--> Sélectionnez le lieu de votre évènement <--</option>
            <?php
            foreach ($lieux as $lieu) {
                ?>
                <option style="color: black;" value="<?=$lieu['idLieu'];?>"><?=$lieu['nomLieu']?></option>
                <?php
            }
            ?>
                
            </select>
            <br><br>
            
            <button type="submit" class="btn bg-purple size2 white" name="creer">Créer l'évènement</button>
        </form>
    </div>


    <!-- footer section starts -->
    <footer class="spacer10">
        <div class="container row jc-between flexcol-s ta-center-s ">
            <div class="row flexcol spacebottom3-s spaceleft3-s">
                
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/affichage.js"></script>


</body>

</html>
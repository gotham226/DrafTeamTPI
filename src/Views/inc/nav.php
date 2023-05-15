<!-- /**
 * Auteur: Gabriel Martin
 * Date: 03.05.2023
 * Description: Page pour la navbar
 * Version 1.0
 */ -->

<div class="container" id="divTop">
        <a  href="/" style="width:15%;"><img src="./assets/img/DTtexteLight.png" href="index.php" style="width:100%;" alt=""></a>
            <!-- <a href="index.php" class="logo bold white">DraF<span class="lightpurple">Team</span></a> -->
            <div class="menu" style="margin-top: 2%;">
            <a href="/" class="liensMenu">Accueil</a>
            <?php
                if(isset($_SESSION['email']) !="")
                {
                    if(isset($_SESSION['idEquipe']) != null){
                        ?>
                            <a href="/monEquipe" class="liensMenu">Equipe</a>
                        <?php
                    }
                ?>  
                    
                    <a href="/agenda" class="liensMenu">Agenda</a>
                    <a href="/championnat" class="liensMenu">Championnat</a>
                    <button id="seConnecter" onclick="location.href='/deconnexion'"  class="btn bg-purple wallet">Se déconnecter</button> 
                <?php
                }else{
                ?>
                    <a id="signInButton" href="/inscription">Inscription</a>
                    <button id="seConnecter" onclick="location.href='/connexion'"  class="btn bg-purple wallet">Se connecter</button> 
                <?php
                }
            ?>
                
                
                
            </div>
            <div class="fas fa-bars" id="bar">
                    
            </div> 

        </div>
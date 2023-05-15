/**
 * Auteur: Gabriel Martin
 * Date: 02.05.2023
 * Description: Page js pour cacher/montrer le mot de passe
 * Version 1.0
 */


// Cette fonction sert à basculer entre l'affichage du mot de passe en clair et son masquage.
function togglePassword() {
    var x = document.getElementById("mdp");
    var eyeIcon = document.getElementById("eye-icon");
    // Vérifie le type actuel de l'élément de saisie du mot de passe
    if (x.type === "password") {
        x.type = "text";
        eyeIcon.src = "./assets/img/cacher.png";
    } else {
        x.type = "password";
        eyeIcon.src = "./assets/img/oeil.png";
    }
}
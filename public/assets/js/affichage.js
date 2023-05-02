//Declaration des variables
let btnAjouter = document.getElementById("newEvent")
let btnCreation = document.getElementById("btnCreation");
let photoProfilUpload = document.getElementById("imgUploadPhotoProfil")
let banniereUpload = document.getElementById("imgUploadBanniere")
let imagePhotoProfil = "./img/profileIcon.png";
let imageBanniere = "./img/fondBlanc.png";





let timer = null;


function GetWindowHeight() {
    btnCreation.style.height = (window.innerHeight - 100) + "px";
}


//Aperçu de l'image de la photo de profil
var LoadPhotoProfil = function (event) {
    image = document.getElementById('outputPhotoProfil');
    imagePhotoProfil = URL.createObjectURL(event.target.files[0])
    photoProfilUpload.style.backgroundImage = "URL(" + URL.createObjectURL(event.target.files[0]) + ")";
}

//Aperçu de l'image de la banniere
var LoadBanniere = function (event) {    
    image = document.getElementById('outputBanniere');
    imageBanniere = URL.createObjectURL(event.target.files[0])

    //change la source de l'image, la centre et l'agrandit à la taille de la bannière.
    banniereUpload.style.background = "URL(" + URL.createObjectURL(event.target.files[0]) + ")";
    banniereUpload.style.backgroundPosition = "center";
    banniereUpload.style.backgroundSize = "cover"
}



//Timer pour le texte du bouton "+"
function TestBouton() {
    let widthBtn = btnAjouter.offsetWidth;
    if (widthBtn == 240) {
        ChangeTextIn()
    }
    else {
        setTimeout(ChangeTextOut, 300)
    }
    

}
//Changement du texte pour le bouton ajouter nft
function ChangeTextIn() {
    btnAjouter.innerText = "+";
    

}
//Changement du texte pour le bouton ajouter nft
function ChangeTextOut() {
    let widthBtn = btnAjouter.offsetWidth;
    if(widthBtn == 70){
        ChangeTextIn();
    }else{
        btnAjouter.innerText = "Ajouter un évenement";
    }
    
    
}

/**
 * Auteur: Gabriel Martin
 * Date: 02.05.2023
 * Description: Page js pour gérer le drag and drop dans la page événement pour les images
 * Version 1.0
 */
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
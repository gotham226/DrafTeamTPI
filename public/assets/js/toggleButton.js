/**
 * Auteur: Gabriel Martin
 * Date: 10.05.2023
 * Description: Page js pour gérer les checkboxes pour l'invitation aux événements
 * Version 1.0
 */

// Cette fonction sert à basculer l'état des cases à cocher entre cochées et décochées.
function toggleCheckboxes() {
    // Récupère tous les éléments de type "checkbox"
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    // Parcourt tous les éléments de type "checkbox"
    for (var i = 0; i < checkboxes.length; i++) {
        // Inverse l'état de la case à cocher en changeant la propriété "checked" à sa valeur opposée
        checkboxes[i].checked = !checkboxes[i].checked;
    }
    var btnToggle = document.getElementById('btn-toggle');
    if (btnToggle.innerHTML === 'Tout cocher') {
        btnToggle.innerHTML = 'Tout décocher';
    } else {
        btnToggle.innerHTML = 'Tout cocher';
    }
}
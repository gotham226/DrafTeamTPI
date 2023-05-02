// Sélectionne tous les boutons de filtres dans l' HTML avec la classe "filter"
let filterBtn = document.querySelectorAll('.filter-buttons .filter')
// Sélectionne tous les éléments dans l' HTML avec la classe "collect"
let filterItem = document.querySelectorAll('.collections .box-card .collect')

// Ajoute un gestionnaire d'événements sur chaque bouton de filtres
filterBtn.forEach(button => {
    // Lorsqu'un bouton est cliqué
    button.onclick = () => {
        // Supprime la classe "active" de tous les boutons
        filterBtn.forEach(btn => btn.classList.remove('active'));
        // Ajoute la classe "active" au bouton qui a été cliqué
        button.classList.add('active');

        // Récupère la valeur de l'attribut "data-filter" du bouton
        let dataFilter = button.getAttribute('data-filter');

        // Boucle sur chaque élément avec la classe "collect"
        filterItem.forEach(item => {
            // Ajoute la classe "hide" et enlève la classe "active" pour chaque élément
            item.classList.remove('active');
            item.classList.add('hide');

            // Si l'élément a la même valeur de l'attribut "data-item" que la valeur récupérée, ou si la valeur est "all"
            if (item.getAttribute('data-item') == dataFilter || dataFilter == 'all') {
                // Enlève la classe "hide" et ajoute la classe "active" à cet élément
                item.classList.remove('hide');
                item.classList.add('active');
            }
        })
    }
})

// Crée un carrousel d'images avec la librairie Swiper pour les éléments avec la classe ".card-slider"
var swiper = new Swiper(".card-slider", {
    effect: "coverflow", // Effet de transition en mode "coverflow"
    grabCursor: true, // Curseur de type "grab"
    centeredSlides: true, // Les diapositives sont centrées
    slidesPerView: "auto", // Le nombre de diapositives par vue est automatique
    coverflowEffect: {
        rotate: 0, // Pas de rotation
        stretch: 0, // Pas d'étirement
        depth: 100, // Profondeur de 100
        modifier: 2, // Modification de 2
        slideShadows: true, // Ajoute des ombres aux diapositives
    },
    loop: true, // Boucle infinie
    autoplay: {
        delay: 3000, // Temps d'attente avant de passer à la diapositive suivante
        disableOnInteraction: false, // Le carrousel continue de défiler même si l'utilisateur interagit avec
    },
});

// Crée un carrousel d'images avec la librairie Swiper pour les éléments avec la classe ".creator-slider"
var swiper = new Swiper(".creator-slider", {
    effect: "coverflow", // Effet de transition en mode "coverflow"
    grabCursor: true, // Curseur de type "grab"
    centeredSlides: true, // Les diapositives sont centrées
    slidesPerView: "auto", // Le nombre de diapositives par vue est automatique
    coverflowEffect: {
        rotate: 0, // Pas de rotation
        stretch: 0, // Pas d'étirement
        depth: 100, // Profondeur de 100
        modifier: 2, // Modification de 2
        slideShadows: true, // Ajoute des ombres aux diapositives
    },
    loop: true, // Boucle infinie
    autoplay: {
        delay: 4000, // Temps d'attente avant de passer à la diapositive suivante
        disableOnInteraction: false, // Le carrousel continue de défiler même si l'utilisateur interagit avec
    },
});
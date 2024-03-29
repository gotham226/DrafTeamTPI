/**
 * Auteur: Gabriel Martin
 * Date: 02.05.2023
 * Description: Page js pour gérer l'agenda afficher sur la page agenda 
 * Version 1.0
 */


var calendar;

// Ajout d'un écouteur d'événement qui se déclenche lorsque le contenu du document est chargé
document.addEventListener('DOMContentLoaded', function() {

    // Récupération de l'élément HTML avec l'id "calendar"
    var calendarEl = document.getElementById('calendar');

    // Création d'une instance de FullCalendar en passant l'élément HTML récupéré précédemment comme paramètre
    // ainsi que d'autres options telles que la vue initiale, l'emplacement du fichier PHP contenant les événements,
    // et d'autres configurations pour les différentes vues du calendrier
    calendar = new FullCalendar.Calendar(calendarEl, {
        
        initialView: 'dayGridMonth',// Pour afficher la vue initial (par mois)
        events: '/agendaEvent',// récupére les events 
        
        // Affichage des boutons en haut du calendrier pour naviger de mois en mois ou semaine en semaine
        headerToolbar: { center: 'dayGridMonth,timeGridWeek' },
        views: { // Les différentes vues :
            dayGrid: {
            contentHeight: 1000
            },
            timeGrid: {

            },
            week: {
                contentHeight: 1000
            },
            day: {

            }
        }
    });


    // Définition de la langue du calendrier en français
    calendar.setOption('locale', 'fr');

    // Affichage du calendrier
    calendar.render();

    // Ajout d'un événement qui se déclenche lorsqu'un événement est cliqué
    calendar.on('eventClick', function(info) {
        // Récupération de l'objet "event" pour obtenir les informations sur l'événement cliqué
        var event = info.event;
        // Récupération de l'identifiant de l'événement cliqué
        var idEvent = event['extendedProps']['publicId'];
        // Redirection vers la page d'affichage de l'événement en passant l'identifiant en paramètre
        window.location.href = '/evenement?idEvenement=' + idEvent;
    });
});



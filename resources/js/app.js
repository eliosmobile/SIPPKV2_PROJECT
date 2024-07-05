import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import Swal from 'sweetalert2';
import '../sass/app.scss'; 

window.showSuccessAlert = function (message) {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: message,
    });
};

window.showErrorAlert = function (message) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: message,
    });
};



document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');
    let calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay'
        },
        dateClick: function(info) {
            alert('Clicked on: ' + info.dateStr);
        },
        events: [
            // Sample events
            {
                title: 'Event 1',
                start: '2024-06-10'
            },
            {
                title: 'Event 2',
                start: '2024-06-15'
            }
        ]
    });
    calendar.render();
});

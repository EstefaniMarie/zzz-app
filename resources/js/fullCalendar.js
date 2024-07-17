import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';
import moment from 'moment';
import 'moment/locale/es';

moment.locale('es');

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const eventos = JSON.parse(calendarEl.dataset.eventos);
    const medicosSelect = document.getElementById('medicos');

    console.log('Eventos:', eventos);
    console.log('Medicos select:', medicosSelect);

    eventos.forEach(evento => {
        console.log('Evento start:', evento.start);
        console.log('Evento end:', evento.end);
    });

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'dayGridDay,dayGridWeek,dayGridMonth'
        },
        events: eventos.map(evento => ({
            title: evento.title,
            start: evento.start,
            end: evento.end,
            backgroundColor: evento.backgroundColor,
            extendedProps: {
                cedulaPaciente: evento.cedulaPaciente // Include cedulaPaciente in the event's extended properties
            }
        })),
        locale: esLocale,
        dayMaxEventRows: true,
        timeZone: 'America/Caracas',
        slotMinTime: '08:00:00',
        slotMaxTime: '16:00:00',
        slotLabelFormat:{
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        },
        weekends: false,
        navLinks: true,
        eventClick: function(info) {
            const cedulaPaciente = info.event.extendedProps.cedulaPaciente;
            if (cedulaPaciente) {
                window.location.href = `/diagnosticos/detalles/${cedulaPaciente}`;
            }
        }
    });

    calendar.render();

    medicosSelect.addEventListener('change', function() {
        const selectedMedicoId = medicosSelect.value;
        const filteredEvents = selectedMedicoId ? eventos.filter(evento => evento.medicoId == selectedMedicoId) : eventos;
        console.log('Filtered Events:', filteredEvents);

        calendar.removeAllEvents();
        calendar.addEventSource(filteredEvents);
    });
});

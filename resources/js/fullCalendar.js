import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';
import moment from 'moment';
import 'moment/locale/es';

moment.locale('es');

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const eventos = JSON.parse(calendarEl.dataset.eventos);

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin, listPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth,listWeek'
        },
        events: eventos,
        locale: esLocale,
        slotMinTime: '08:00:00',
        slotMaxTime: '16:00:00',
        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        },
        columnHeaderFormat: {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        }
    });

    calendar.render();

    $('.medicos').change(function() {
        var medicoId = $(this).val();
        loadCitas(medicoId);
    });

    function loadCitas(medicoId) {
        $.ajax({
            url: '/getCitasxMedico',
            type: 'GET',
            data: { medicoId: medicoId },
            success: function(data) {
                var events = [];
                data.forEach(function(cita) {
                    events.push({
                        title: cita.paciente.persona.nombres + ' ' + cita.paciente.persona.apellidos,
                        start: cita.consulta.start_date,
                        end: cita.consulta.end_date
                    });
                });
                calendar.removeAllEvents();
                calendar.addEventSource(events)
            },
            error: function() {
                console.error('Error al obtener las citas del médico');
            }
        });
    }
});

import { Calendar } from "https://cdn.skypack.dev/@fullcalendar/core";
import dayGridPlugin from "https://cdn.skypack.dev/@fullcalendar/daygrid";
import timeGridPlugin from "https://cdn.skypack.dev/@fullcalendar/timegrid";
import listPlugin from "https://cdn.skypack.dev/@fullcalendar/list";
import multiMonthPlugin from "https://cdn.skypack.dev/@fullcalendar/multimonth";

function initCalendar() {
  let calendarEl = document.getElementById('calendar');
  if(!calendarEl) return;
  let calendar = new Calendar(calendarEl, {
    plugins: [ dayGridPlugin, timeGridPlugin, listPlugin, multiMonthPlugin ],
    initialView: 'timeGridWeek',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,listWeek'
    },
    multiMonthMaxColumns: 1, 
    firstDay: 1,
    hiddenDays: [6, 0], 
    nowIndicator: true,
    locale: 'fr',
    events: '/events',
    
    eventClick: function(info) {
                if (info.event.backgroundColor = "red") {
                  return;
                }
                let urlTemplate = calendarEl.dataset.url;
                let url = urlTemplate.replace('BOOKLET_ID', info.event.id);
                window.location.href = url;
            }
  });
  calendar.render();
}

// Ré-init quand EasyAdmin ajoute un élément dans une collection
document.addEventListener('ea.collection.item-added', (event) => {
    initCalendar(event.target);
});

document.addEventListener('turbo:load', initCalendar);
@extends('admin.layouts.app')
@section('content')


<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER  -->
        <div class="page-header d-lg-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Calendar</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class=" btn-list">
                    {{-- <button  class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
                    <button  class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
                    <button  class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> --}}
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER  -->

                @php
                $employeBirthday = getEmployeesWithUpcomingBirthdays();
                $events = getEvents();
                @endphp

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar" class="position-sticky"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->


@endsection


@section('scripts')

<script>
    var holidays = {!! json_encode($holidays) !!};
    var employeBirth = {!! json_encode($employeBirthday) !!};
    var event = {!! json_encode($events) !!};

    /******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************!*\
  !*** ./resources/assets/js/app-calendar.js ***!
  \*********************************************/
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//________ FullCalendar
var curYear = moment().format('YYYY');
var curMonth = moment().format('MM'); // Calendar Event Source

var sptCalendarEvents = {
  id: 1,
  events: [],
}; 

for (var i = 0; i < event.length; i++) {
  sptCalendarEvents.events.push({
    id: event[i].id,
    start: event[i].date,
    end: event[i].date,
    title: event[i].title,
    backgroundColor: 'rgba(71, 84, 242, 0.2)',
    borderColor: 'rgba(71, 84, 242, 0.2)',
    description: 'Event',
  });
}

var sptBirthdayEvents = {
  id: 2,
  backgroundColor: 'rgba(1, 195, 83, 0.2)',
  borderColor: 'rgba(1, 195, 83, 0.2)',
  events: []
}; 

for (var i = 0; i < employeBirth.length; i++) {
  sptBirthdayEvents.events.push({
    id: employeBirth[i].id,
    start: employeBirth[i].d_o_b,
    end: employeBirth[i].d_o_b,
    title: employeBirth[i].name + "'s Birthday",
    backgroundColor: 'rgba(1, 195, 83, 0.2)',
    borderColor: 'rgba(1, 195, 83, 0.2)',
    description: 'Happy Birthday ' + employeBirth[i].name,
  });
}

var sptHolidayEvents = {
  id: 3,
  backgroundColor: 'rgba(240, 74, 32, 0.2)',
  borderColor: 'rgba(240, 74, 32, 0.2)',
  events: []
}; 

for (var i = 0; i < holidays.length; i++) {
  sptHolidayEvents.events.push({
    id: holidays[i].id,
    start: holidays[i].start_date,
    end: holidays[i].end_date,
    title: holidays[i].title
  });
}

var sptOtherEvents = {

};

document.addEventListener('DOMContentLoaded', function () {
  var _FullCalendar$Calenda;

  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, (_FullCalendar$Calenda = {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    navLinks: true,
    businessHours: true,
    editable: true,
    selectable: true,
    selectMirror: true,
    droppable: true,
    drop: function drop(arg) {
      if (document.getElementById('drop-remove').checked) {
        arg.draggedEl.parentNode.removeChild(arg.draggedEl);
      }
    },
    select: function select(arg) {
      var title = prompt('Event Title:');

      if (title) {
        calendar.addEvent({
          title: title,
          start: arg.start,
          end: arg.end,
          allDay: arg.allDay
        });
      }

      calendar.unselect();
    },
    eventClick: function eventClick(arg) {
      if (confirm('Are you sure you want to delete this event?')) {
        arg.event.remove();
      }
    }
  }, _defineProperty(_FullCalendar$Calenda, "editable", true), _defineProperty(_FullCalendar$Calenda, "eventSources", [sptCalendarEvents, sptBirthdayEvents, sptHolidayEvents, sptOtherEvents]), _FullCalendar$Calenda));
  calendar.render();
});
   })()
;
</script>

@endsection
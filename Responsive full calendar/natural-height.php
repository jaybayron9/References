<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="index.global.js"></script>

  <style>
    body {
      margin: 40px 10px;
      padding: 0;
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }

    #calendar {
      max-width: 1100px;
      margin: 0 auto;
    }

    .calendar .fc-header-toolbar {
      display: block;
      text-align: center;
    }

    .calendar .fc-header-toolbar .fc-left,
    .calendar .fc-header-toolbar .fc-center,
    .calendar .fc-header-toolbar .fc-right {
      float: left;
    }

    .calendar .fc-header-toolbar .fc-left {
      width: 33.3333%;
    }

    .calendar .fc-header-toolbar .fc-center {
      width: 33.3333%;
    }

    .calendar .fc-header-toolbar .fc-right {
      width: 33.3333%;
    }
  </style>
</head>

<body>
  <form id="reservation-form" style="display: none;">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br>
    <label for="date">Date:</label><br>
    <input type="date" id="date" name="date"><br><br>
    <input type="submit" value="Submit">
  </form>

  <div id="event-info" style="display: none;">
    <h3 id="event-title"></h3>
    <p>Schedule ID: <span id="event-id"></span></p>
    <p>Start: <span id="event-start"></span></p>
  </div>

  <div id="edit-form" style="display: none;">
    <form>
      <label for="event-title">Title:</label><br>
      <input type="text" id="event-title-input" name="event-title"><br>
      <label for="schedule id">Schedule ID:</label><br>
      <input type="text" id="event-id-input" name="event-start"><br>
      <label for="event-start">Start:</label><br>
      <input type="text" id="event-start-input" name="event-start"><br>
      <button type="submit">Save</button>
    </form>
  </div>

  <div id="calendar" class="fc-header-toolbar"></div>

  <script>
    $(document).ready(function() {
      var calendarEl = $('#calendar');

      if ($(window).width() < 600) {
        $('#calendar').addClass('calendar');
      }

      $.ajax({
        url: 'get-events.php',
        dataType: 'json',
        success: function(events) {
          var calendar = new FullCalendar.Calendar(calendarEl[0], {
            initialDate: new Date(),
            initialView: 'dayGridMonth',
            headerToolbar: {
              left: 'prevYear,prev,next,nextYear today',
              center: 'title',
              right: 'listYear,dayGridMonth,timeGridWeek,timeGridDay',
            },
            views: {
              listYear: {
                buttonText: 'year'
              }
            },
            height: 'auto',
            navLinks: false, // can click day/week names to navigate views
            editable: true,
            selectable: true,
            selectMirror: false,
            nowIndicator: false,
            eventOrder: 'start',
            timeFormat: 'h:mm a',
            events: events
          });
          calendar.render();

          calendar.on('select', function(info) {
            // handle day selection
            console.log(info.startStr); // date string of the selected day
          });

          calendar.on('select', function(info) {
            // show reservation form
            $('#reservation-form').show();
            $('#date').val(info.startStr);
          });

          calendar.on('eventClick', function(info) {
            // show event information in view field
            var event = info.event;
            $('#event-title').text(event.title);
            $('#event-id').text(event.id);
            $('#event-start').text(event.start);
            $('#event-info').show();
          });

          calendar.on('eventClick', function(info) {
            // show edit form
            var event = info.event;
            $('#event-title-input').val(event.title);
            $('#event-id-input').val(event.id);
            $('#event-start-input').val(event.start);
            $('#event-end-input').val(event.end);
            $('#edit-form').show();
          });

          calendar.on('eventDrop', function(info) {
            // get event data
            var event = info.event;
            var id = event.id;
            var start = event.start;

            // Convert the start parameter to a valid ISO-8601 date and time string
            var startIsoString = start.toISOString();

            // update event in the database
            $.ajax({
              url: 'update-event.php',
              data: {
                start: startIsoString,
                id: id
              },
              type: 'POST',
              success: function(response) {
                // Update the event in the calendar
                calendar.refetchEvents();
              }
            });
          });

          $(window).on('resize', function() {
            if (calendar) {
              calendar.setOption('height', calendarEl.parent().height());
              calendar.refetchEvents();
              calendar.updateSize();

              if ($(window).width() < 530) {
                $('#calendar').addClass('calendar');
              } else {
                $('#calendar').removeClass('calendar');
              }
            }
          });
        }
      });
    });
  </script>
</body>

</html>
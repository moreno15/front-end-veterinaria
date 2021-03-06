<?php
$url = CurlController::api()."citas?select=*&linkTo=estado&equalTo=0";
$method = "GET";
$fields = array();
$header = array();


$dataEvento = CurlController::request($url, $method, $fields, $header)->results;


 ?>
<div class="content-wrapper" style="min-height: 1071.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registrar Citas </h1>
            <div class="col-lg-12 mt-3">
              <div class="row">
                    <div class=" external-event" style="background:#6F5802;color:#fff;font-size:11px" >Grooming</div>
                    <div class=" external-event" style="background:#C70039;color:#fff;font-size:11px" >Internación</div>
                    <div class=" external-event" style="background:#FE6E2A;color:#fff;font-size:11px" >Consulta</div>

                    <div class="  external-event"  style="background:#026F26;color:#fff;font-size:11px">Vacunacion</div>
                    <div class="  external-event"  style="background:#022D6F;color:#fff;font-size:11px">Cirugia</div>
                    <div id="external-events">
                    </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body p-0">
                     <!-- THE CALENDAR -->
                       <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->


    </section>

    <!-- /.content -->
  </div>
<script type="text/javascript">

 $(function () {

   /* initialize the external events
    -----------------------------------------------------------------*/
   function ini_events(ele) {
     ele.each(function () {

       // create an Event Object (https://fullcalendar.io/docs/event-object)
       // it doesn't need to have a start or end
       var eventObject = {
         title: $.trim($(this).text()) // use the element's text as the event title
       }

       // store the Event Object in the DOM element so we can get to it later
       $(this).data('eventObject', eventObject)

       // make the event draggable using jQuery UI
       $(this).draggable({
         zIndex        : 1070,
         revert        : true, // will cause the event to go back to its
         revertDuration: 0  //  original position after the drag
       })

     })
   }

   ini_events($('#external-events div.external-event'))

   /* initialize the calendar
    -----------------------------------------------------------------*/
   //Date for the calendar events (dummy data)

   var Calendar = FullCalendar.Calendar;
   var Draggable = FullCalendar.Draggable;

   var containerEl = document.getElementById('external-events');
   var checkbox = document.getElementById('drop-remove');
   var calendarEl = document.getElementById('calendar');

   // initialize the external events
   // -----------------------------------------------------------------

   new Draggable(containerEl, {
     itemSelector: '.external-event',
     eventData: function(eventEl) {
       return {
         title: eventEl.innerText,
         backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
         borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
         textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
       };
     }
   });

   var calendar = new Calendar(calendarEl, {
     headerToolbar: {
       left  : 'prev,next today',
       center: 'title',
       right : 'dayGridMonth,timeGridWeek,timeGridDay'
     },
     themeSystem: 'bootstrap',
     //Random default events
     events: [
       <?php
       		date_default_timezone_set("America/Lima");

          if ($dataEvento!="Not Found") {
            foreach ($dataEvento as $key => $value) {

              $hora=explode(" ", $value->hora_cita);
              $horaMin=explode(":",$hora[0]);

              if ($hora[1]=="PM") {
                $h=$horaMin[0];
                 switch ($h) {
                   case 1:
                      $horaMin[0]=13;
                   break;
                   case 2:
                      $horaMin[0]=14;
                   break;
                   case 3:
                      $horaMin[0]=15;
                   break;
                   case 4:
                      $horaMin[0]=16;
                   break;
                   case 5:
                     $horaMin[0]=17;
                   break;
                   case 6:
                     $horaMin[0]=18;
                   break;
                   case 7:
                      $horaMin[0]=19;
                   break;
                   case 8:
                     $horaMin[0]=20;
                   break;
                   case 9:
                     $horaMin[0]=21;
                   break;
                   case 10:
                     $horaMin[0]=22;
                   break;
                   case 11:
                     $horaMin[0]=23;
                   break;
                   case 12:
                     $horaMin[0]=24;
                   break;

                 }
              }




              $fecha=date_create($value->fecha_cita);

              $anio=date_format($fecha,'Y');
              $mes=date_format($fecha,'m');
              $dia=date_format($fecha,'d');
              $color="";
              switch ($value->servicio_cita) {
                case 'Grooming':
                    $color="#6F5802";
                  break;
              case 'Consulta':
                    $color="#FE6E2A";
              }
          ?>
            {
              title:"<?php echo $value->cliente_cita ?>",
              start: new Date(<?=$anio ?>, <?=$mes-1 ?>, <?=$dia ?>,<?=$horaMin[0] ?> , <?= $horaMin[1] ?>),
              backgroundColor:"<?php echo $color ?>",
              borderColor: "<?php echo $color ?>",
              allDay: false
            },
        <?php }   } ?>

     ],
     locale: "es",
     editable  : true,
     droppable : true, // this allows things to be dropped onto the calendar !!!

   });
   calendar.render();
   // $('#calendar').fullCalendar()

   /* ADDING EVENTS */
   var currColor = '#3c8dbc' //Red by default
   // Color chooser button
   $('#color-chooser > li > a').click(function (e) {
     e.preventDefault()
     // Save color
     currColor = $(this).css('color')
     // Add color effect to button
     $('#add-new-event').css({
       'background-color': currColor,
       'border-color'    : currColor
     })
   })
   $('#add-new-event').click(function (e) {
     e.preventDefault()
     // Get value and make sure it is not null
     var val = $('#new-event').val()
     if (val.length == 0) {
       return
     }

     // Create events
     var event = $('<div />')
     event.css({
       'background-color': currColor,
       'border-color'    : currColor,
       'color'           : '#fff'
     }).addClass('external-event')
     event.text(val)
     $('#external-events').prepend(event)

     // Add draggable funtionality
     ini_events(event)

     // Remove event from text input
     $('#new-event').val('')
   })
 })
</script>

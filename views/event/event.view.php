<?php require_once('views/layout/header.php'); ?>
<?php require_once('views/layout/navbar.php'); ?>
<section class="main-container bg-additional-grey" id="fullscreen">
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-flex my-3">
            <div id="table-actions" class="flex-grow-1 align-items-center">
                <i class="bi bi-circle-fill m-2" style="color: #3366ff;"></i> Project
                <i class="bi bi-circle-fill m-2" style="color: #FF6600;"></i> Task
                <i class="bi bi-circle-fill m-2" style="color: #FF0000;"></i> Birthday
            </div>
        </div>

        <div class="card bg-white border-0 b-shadow-4">

            <div class="card-body ">
                <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-standard">


                </div>
            </div>
        </div>
    </div>


</section>
<?php require_once('views/layout/footer.php'); ?>

<script>
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'en',
        timeZone: 'Europe/Lisbon',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        navLinks: true, // can click day/week names to navigate views
        selectable: false,
        selectMirror: true,
        select: function(arg) {
            var title = prompt('Event Title:');
            if (title) {
                calendar.addEvent({
                    title: title,
                    start: arg.start,
                    end: arg.end,
                    allDay: arg.allDay
                })
            }
            calendar.unselect()
        },
        eventClick: function(arg) {
            var type = arg.event.extendedProps.type;
            var id = arg.event.extendedProps.idEvent;

            if (type == 'Project') {
                window.location.href = "<?=ROOT ?>/project/" + id;
            } else if (type == 'Task') {
                window.location.href = "<?=ROOT ?>/task/" + id;
            } else if (type == 'Birthday') {
                window.location.href = "<?=ROOT ?>/employee/" + id;
            }
        },
        editable: false,
        dayMaxEvents: true, // allow "more" link when too many events
        events: <?=json_encode($eventsCalendar);?> ,
        eventDidMount: function(info) {
            $(info.el).attr('data-toggle', 'tooltip');
            $(info.el).attr('data-placement', 'top');
            $(info.el).attr('title', info.event.extendedProps.type);
            console.log(info.event)
        }
    });
    calendar.render();
</script>
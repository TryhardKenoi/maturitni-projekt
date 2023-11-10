<?php
$events_data = [];

foreach ($events as $event) {
    $title = $event['nazev_eventu'];
    $start = $event['zacatek_eventu'];
    $end = $event['konec_eventu'];
    $color = $event['color'];

    // Přidejte data události do pole
    $events_data[] = [
        'title' => $title,
        'start' => $start,
        'end' => $end,
        'color' => $color
    ];
}
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
  <title>Kenoi's website</title>
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/custom.css'); ?>">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <meta charset='utf-8' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <?= $this->include('layout/navbar') ?>

  </head>
  <body>

  <div class="text-center pt-5">
    <a href="/final/pridejEvent"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">
      Přidej event
    </button></a>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>



  </div>

  <div class="px-3" id="calendar"></div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.9/index.global.min.js'></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
      height: 550,

      initialView: 'dayGridMonth',
      events: <?php echo json_encode($events_data); ?>,

      eventClick: function(info) {
        modalLabel = document.getElementById('exampleModalLabel');
        modalLabel.innerHTML = info.event.title;
        // Kód, který se provede po kliknutí na událost
        console.log('Event clicked:', info.event);
        openModal(event);


        function openModal(event){
          $('#exampleModal').modal('show');
        }
      },
  });
  calendar.render();
  });
</script>

  </body>
</html>

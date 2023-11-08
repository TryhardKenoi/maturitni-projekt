<?php 
$events_data = [];

foreach ($events as $event) {
    $title = $event['nazev_eventu'];
    $start = $event['zacatek_eventu'];
    $end = $event['konec_eventu'];

    // Přidejte data události do pole
    $events_data[] = [
        'title' => $title,
        'start' => $start,
        'end' => $end,
    ];
}
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
  <title>Kenoi's website</title>
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/custom.css'); ?>">
    <meta charset='utf-8' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.9/index.global.min.js'></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: <?php echo json_encode($events_data); ?> // Předáváme pole s daty událostí
    });
    calendar.render();
  });
</script>

    </script>
  </head>
  <body>
      
  <div class="text-center pt-5">
    <a href="/valenta-kalendar/pridejEvent"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
      Přidej event
    </button></a>
    
  </div>

    
  <div id="calendar"></div>

  </body>
</html>
    
 
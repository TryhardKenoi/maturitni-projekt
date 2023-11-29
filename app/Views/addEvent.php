<!DOCTYPE html>
<html lang='en'>
  <head>
  <title>Kenoi's website</title>
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/custom.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <meta charset='utf-8' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.9/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  </head>
  <body>

    <div class="container mt-5">
      <h1>Přidejte event</h1>
      <form action="<?php echo base_url('/create'); ?>" method="post">
          <div class="mb-3">
              <label for="nazev" class="form-label">Název eventu</label>
              <input type="name" class="form-control" id="nazev_eventu" name="nazev_eventu">
          </div>
          <div class="mb-3">
            <label for="rozgah_datum" class="form-label">Rozsah eventu</label>
            <input type="text" class="form-control" id="rozgah_datum" name="rozgah_datum" placeholder="Vyberte rozsah datumů">
        </div>
          <div>
              <label for="color">Vyberte barvu:</label>
              <input type="color" id="color" name="color" value="#0BA0E0">
          </div>
          <button type="submit" id="testing" class="btn btn-primary">Odeslat</button>
      </form>
  </div>

  <script>
      flatpickr("#rozgah_datum", {
          enableTime: false,
          mode: "range",
          dateFormat: "Y-m-d",

      });
  </script>
  </body>
</html>

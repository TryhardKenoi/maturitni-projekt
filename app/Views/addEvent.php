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
                <label for="datum1" class="form-label">Začátek eventu</label>
                <input type="date" class="form-control" id="zacatek_eventu" name="zacatek_eventu">
            </div>
            <div class="mb-3">
                <label for="datum2" class="form-label">Konec eventu</label>
                <input type="date" class="form-control" id="konec_eventu" name="konec_eventu">
            </div>
            <button type="submit" class="btn btn-primary">Odeslat</button>
        </form>
    </div>

  </body>
</html>
    
 
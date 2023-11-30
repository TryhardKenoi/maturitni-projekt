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

    <?= $this->include('layout/navbar') ?>

  </head>
  <body>
    <div class="text-center pt-3">
      <h1>Vítejte, <?= \App\Helpers\User::user()->first_name; ?></h1>
    </div>
<div class="col-12">
  <h2>Údaje</h2>

  <p>Name: <?= \App\Helpers\User::user()->first_name; ?> <?= \App\Helpers\User::user()->last_name; ?></p>
  <p>Email: <?= \App\Helpers\User::user()->email; ?></p>
  <p>Firma: <?= \App\Helpers\User::user()->company; ?></p>
  <p>ID: <?= \App\Helpers\User::user()->id; ?></p>
</div>
  </body>
</html>

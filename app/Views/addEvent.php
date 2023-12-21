<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

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
      enableTime: true,
      mode: "range",
      dateFormat: "Y-m-d H:i",

  });
</script>

<?= $this->endSection(); ?>

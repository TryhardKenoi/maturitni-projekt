<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="text-center pt-3">
  <h1><b>Event</b></h1>
  <hr>
</div>



<div class="" id="hide-show">
      <h5><b>Název eventu: </b><?= $event->nazev_eventu; ?></h3>
      <p><b>Začátek eventu: </b><span class="" id="zacatek"> <?= $event->zacatek_eventu ?></span></p>
      <p><b>Konec eventu: </b><span id="konec"><?= $event->konec_eventu ?></span></p>

      <button type="button" id="editButton" class="btn btn-secondary" name="button">Upravit</button>
      <button type="submit" id="submitButton" class="btn btn-secondary" disabled name="button">Odeslat</button>
</div>


<div class="" style="display: none;" id="showForm">
    <form class="" action="<?= base_url('/event/edit/').'/'.$event->id ?>" method="post">
      <div class="form-group">
        <label for="name">Název eventu</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $event->nazev_eventu; ?> ">
      </div>
      <div class="form-group">
        <label for="start">Začátek eventu</label>
        <input type="text" class="form-control" id="start" name="start" value="<?= $event->zacatek_eventu; ?> ">
      </div>
      <div class="form-group">
        <label for="end">Konec eventu</label>
        <input type="text" class="form-control" id="end" name="end" value="<?= $event->konec_eventu; ?> ">
      </div>
      <div>
          <label for="description">Popisek</label>
          <input type="text" class="form-control" id="description" name="description" value="">
      </div>
      <div>
          <label for="color">Barva</label>
          <input type="color" id="color" name="color" value="<?= $event->color; ?>">
      </div>
      <button type="submit" id="submitButton" class="btn btn-secondary" name="button">Odeslat</button>
  </form>
</div>

<script>
  var divForm = document.getElementById('showForm');
  var divHide = document.getElementById('hide-show');
  document.getElementById('editButton').addEventListener('click', function() {
    divHide.style.display = 'none';
    divForm.style.display = 'block';



    var buttonE = document.getElementById('editButton');
    var buttonS = document.getElementById('submitButton');

    buttonE.disabled = true;
    buttonS.disabled = false;

  });
</script>

<?= $this->endSection(); ?>

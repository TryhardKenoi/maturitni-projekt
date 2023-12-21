<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="text-center pt-3">
  <h1><b>Event</b></h1>
  <hr>
</div>

<div class="">
  <h5><b>Název eventu: </b><?= $event->nazev_eventu; ?></h3>
    <p><b>Začátek eventu: </b><span class="" id="zacatek"> <?= $event->zacatek_eventu ?></span></p>
    <p><b>Konec eventu: </b><span id="konec"><?= $event->konec_eventu ?></span></p>
    <button type="button" id="editButton" class="btn btn-secondary" name="button">Upravit</button>
    <button type="button" id="submitButton" class="btn btn-secondary" disabled name="button">Odeslat</button>
</div>

<script>
  document.getElementById('editButton').addEventListener('click', function() {
    // Získání elementů span
    var zacatekSpan = document.getElementById('zacatek');
    var konecSpan = document.getElementById('konec');

    // Získání textových hodnot ze spanů
    var zacatekText = zacatekSpan.textContent;
    var konecText = konecSpan.textContent;

    // Rozdělení textu na datum a čas
    var zacatekParts = zacatekText.split(' ');
    var konecParts = konecText.split(' ');

    // Vytvoření inputů pro úpravu
    var editZacatekDate = '<input type="date" id="editZacatekDate" value="' + zacatekParts[1] + '">';
    var editZacatekTime = '<input type="time" id="editZacatekTime" value="' + zacatekParts[2] + '">';

    var editKonecDate = '<input type="date" id="editKonecDate" value="' + konecParts[0] + '">';
    var editKonecTime = '<input type="time" id="editKonecTime" value="' + konecParts[1] + '">';

    // Nahrazení spanů inputy pro úpravu
    zacatekSpan.innerHTML = 'Nový začátek eventu: ' + editZacatekDate  + editZacatekTime;
    konecSpan.innerHTML = 'Nový konec eventu: ' + editKonecDate + editKonecTime + '<hr>';

    var buttonE = document.getElementById('editButton');
    var buttonS = document.getElementById('submitButton');

    buttonE.disabled = true;
    buttonS.disabled = false;

  });
</script>

<?= $this->endSection(); ?>

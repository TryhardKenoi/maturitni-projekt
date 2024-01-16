<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="text-center pt-3">
  <h1><b>Event</b></h1>
  <hr>
</div>

<div class="" id="showForm">
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
          <input type="text" class="form-control" id="description" name="description" value="<?= $event->description; ?>">
      </div>
      <div>
          <label for="color">Barva</label>
          <input type="color" id="color" name="color" value="<?= $event->color; ?>">
      </div>
      <div class="pb-5">
          <label for="location">Místo konání</label>
          <input type="text" name="latitute" value="<?= $event->latitute; ?>" id="latitute" readonly />
          <input type="text" name="longtitute" value="<?= $event->longtitute;?>" id="longtitute" readonly />
          <div id="map" style="height: 400px;"></div
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([50,14], 9);
            var marker;

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            marker = L.marker([<?= $event->latitute?>, <?= $event->longtitute?>]).addTo(map);

            var latitute = document.getElementById('latitute');
            var longtitute = document.getElementById('longtitute');

            map.on('click', function (e) {
                var latlng = e.latlng;

                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker(latlng).addTo(map);
                latitute.value = latlng.lat;
                longtitute.value = latlng.lng;
            });
        });
    </script>
      </div>
      <button type="submit" id="submitButton" class="btn btn-secondary" name="button">Odeslat</button>
  </form>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<?= $this->endSection(); ?>

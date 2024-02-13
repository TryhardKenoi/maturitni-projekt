<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="text-center pt-3">
  <h1><b>Event</b></h1>
  <hr>
</div>

<div class="container" id="showForm">
    <form class="" action="<?= base_url('admin/event/edit/submit').'/'.$event->id ?>" method="post">
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
          <div id="map" style="height: 400px;"></div>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        
        <script>
        var la = <?= json_encode($event->latitute) ?>;
        var lo = <?= json_encode($event->longtitute) ?>;
        document.addEventListener('DOMContentLoaded', function () {
          if(la != null && lo != null){
              var map = L.map('map').setView([la, lo], 9);
            }else{
              var map = L.map('map').setView([50,15], 7);
            }
            var marker;
            

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            if(la != null && lo != null){
              marker = L.marker([la,lo]).addTo(map);
            }
            

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
      <?php if($event->creator_id == \App\Helpers\User::user()->id): ?> 
        <button type="submit" id="submitButton" class="btn btn-secondary" name="button">Odeslat</button> 
      <?php endif; ?>
  </form>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  const userId = '<?= \App\Helpers\User::user()->id; ?>';
  const eventId = '<?= $event->creator_id; ?>';
  const isOwner = (userId == eventId) ? true : false;
  console.log(isOwner);
  if(!isOwner) {
    const item = document.querySelectorAll(".form-control");

    item.forEach((element, index) => {
      element.setAttribute('readonly', index);
    });
  }
</script>
<?= $this->endSection(); ?>

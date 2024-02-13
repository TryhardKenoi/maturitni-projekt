<?php
$events_data = [];

foreach ($events as $event) {
    $id = $event->id;
    $title = $event->nazev_eventu;
    $start = $event->zacatek_eventu;
    $end = $event->konec_eventu;
    $color = $event->color;

    // Přidejte data události do pole
    $events_data[] = [
        'test' => $id,
        'title' => $title,
        'start' => $start,
        'end' => $end,
        'color' => $color,
        'allDay' => (strstr($start, "00:00:00"))?true:false
    ];
}
?>

<?= $this->extend('layout/Master'); ?>
<?= $this->section('content'); ?>
  <div class="text-center pt-5">
    <?php if (\App\Helpers\User::isLoggedIn()): ?>

    <a href="<?= base_url('/pridejEvent'); ?>"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">
      Přidej event
    </button></a>
  <?php endif; ?>
    <button id="showWeekBtn" class="btn btn-secondary" type="button" name="button">Týden</button>
    <button id="showMonthBtn" class="btn btn-secondary" type="button" name="button">Měsíc</button>

    <div class="modal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <div class="barvicka">

            </div>
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-desc">

          </div>
          <div class="modal-body">
          </div>
          <div class="modal-body2"></div> <br>
          <div class="modal-body3"></div> 
          <div class="modal-body4"></div> <br>
          <div class="modal-footer d-flex justify-content-center">
            <a href="" id="moreButton" type=""  class="btn btn-primary">Více</a>
          </div>
        </div>
      </div>
    </div>



  </div>

  <div class="px-3" id="calendar"></div>


<script type="text/javascript" src="<?= base_url('/assets/bootstrap/js/jquery.js'); ?>"></script>
<script>
$(document).ready(function() {

  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
      timeZone: 'Europe/Prague',
      height: 550,
      initialView: 'dayGridMonth',
      droppable: true,
      events: <?= $eventsList ?>,
      eventClick: function(info) {
        modalLabel = document.getElementById('exampleModalLabel');
        
        // Kód, který se provede po kliknutí na událost
        const eventId = info.event._def.publicId;
        const url = "<?= base_url('/event') ?>"+'/'+eventId;

        $.ajax(url,{  //ajax = pomůcka, která dovolí poslat request na server, aniž bych musel obnovit stránku
          type: 'GET',  //typ routy (např. POST, GET)
          success: function(data) { //funkce s parametrem data, data = hodnota
            const event = JSON.parse(data); //do proměnné event přidám data v jazyku JSONU
            $('.modal-title').html(event.nazev_eventu);  //itemu, který obsahu třídu "modal-title", nastavím html obsah na event.nazev_eventu
            $('.barvicka').css('background-color', event.color);
            $('.modal').addClass('show');
            console.log(event);
            let formattedStDate;
            let formattedEnDate;
            if(event.allDay == true){
              formattedStDate = moment(event.zacatek_eventu).format('D.M.YYYY');
              formattedEnDate = moment(event.konec_eventu).format('D.M.YYYY');
            }else{
              formattedStDate = moment(event.zacatek_eventu).format('D.M.YYYY HH:mm');
              formattedEnDate = moment(event.konec_eventu).format('D.M.YYYY HH:mm');
            }
            $('.modal-body').html("Začátek eventu: " +formattedStDate);
            $('.modal-body2').html("Konec eventu: " +formattedEnDate);
            $('#moreButton').attr('href', '<?= base_url('/event/edit')?>' + '/' +event.id);

            //skupiny
            if(event.groups.length > 0) {
              $('.modal-body3').html("Skupiny: " +event.groups.map((group) => group.name));
                  // eventy.groups[0], eventy.groups[1], 
            }else {
              $('.modal-body3').html("");
            }

            //uzivatele
            if(event.users.length > 0) {
              $('.modal-body4').html("Uživatelé: " +event.users.map((user) => user.first_name));
                  // eventy.groups[0], eventy.groups[1], 
            }else {
              $('.modal-body4').html("");
            }

            if(event.description != null){
               $('.modal-desc').html("Popisek: "+event.description);
               console.log(event.description);
            }else{

            }


          },
          error: function(xhr, status, error) {
            console.log(error); //chybová hláška
          }
      });

    },
  });
  calendar.setOption('locale', 'cs');
  calendar.render();

    // Funkce pro změnu zobrazení na týdenní
    document.getElementById('showWeekBtn').addEventListener('click', function() {
          calendar.changeView('timeGridWeek');
    });

    // Funkce pro změnu zobrazení na měsíční
    document.getElementById('showMonthBtn').addEventListener('click', function() {
      calendar.changeView('dayGridMonth');
    });

});

</script>

<?= $this->endSection(); ?>

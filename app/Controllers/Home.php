<?php

namespace App\Controllers;
use App\Models\EventModel;
use App\Models\GetEvent;
use App\Libraries\Datum;
class Home extends BaseController
{
  var $datum;
  function __construct(){
    $this->datum = new Datum();
  }
    public function index()
    {
        $model = new GetEvent();
        $events = $model->findAll(); // Toto získá všechny události z databáze

        return view('index', ['events' => $events]);
    }

    public function addEvent(){
        return view('addEvent');
    }

    public function create(){
        $data = [
        'nazev_eventu' => $this->request->getPost('nazev_eventu'),
        'zacatek_eventu' => null,
        'konec_eventu' => null,
        'color' => $this->request->getPost('color'),
    ];

    $rozgahDatum = $this->request->getPost('rozgah_datum'); // Opravený název proměnné
    if ($rozgahDatum) {
      $datum = $this->datum->splitDate($rozgahDatum);
      $data['zacatek_eventu'] = $datum['zacatek_eventu'];
      $data['konec_eventu'] = $datum['konec_eventu'];
    }


        $db = \Config\Database::connect();
        $builder = $db->table('eventy');
        $builder->insert($data);
        return redirect('/');
    }

}

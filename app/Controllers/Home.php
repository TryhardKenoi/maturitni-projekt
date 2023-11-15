<?php

namespace App\Controllers;
use App\Models\EventModel;
use App\Models\GetEvent;
class Home extends BaseController
{
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
        'color' => $this->request->getPost('color')
    ];

    $datum = $this->request->getPost('datum');
    if ($datum) {
        $splitDatum = explode(" to ", $datum);
        $data['zacatek_eventu'] = date('Y-m-d', strtotime($rozgah[0]));
        $data['konec_eventu'] = date('Y-m-d', strtotime($rozgah[1]));
    }


        $db = \Config\Database::connect();
        $builder = $db->table('eventy');
        $builder->insert($data);
        return redirect('/');
    }

}

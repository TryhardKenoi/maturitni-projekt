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
        //$model = new EventModel();
        $data = [
            'nazev_eventu' => $this->request->getPost('nazev_eventu'),
            'zacatek_eventu' => $this->request->getPost('zacatek_eventu'),
            'konec_eventu' => $this->request->getPost('konec_eventu'),
            'color' => $this->request->getPost('color')
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('eventy');
        $builder->insert($data);
        return redirect('/');
    }

}

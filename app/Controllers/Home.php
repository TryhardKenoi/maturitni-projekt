<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\GetEvent;
use App\Libraries\Datum;

class Home extends BaseController
{
  var $datum;
  function __construct()
  {
    $this->datum = new Datum();
  }
  public function index()
  {
    $model = new GetEvent();
    $events = $model->getDataWithID();
    //$events = $model->findAll();
    return view('index', ['events' => $events]);
  }

  public function addEvent()
  {
    return view('addEvent');
  }

  public function create()
  {
    $data = [
      'nazev_eventu' => $this->request->getPost('nazev_eventu'),
      'zacatek_eventu' => null,
      'konec_eventu' => null,
      'color' => $this->request->getPost('color'),
      'user_id' => \App\Helpers\User::user()->id
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


  public function profil()
  {
    return view('profil');
  }

  public function createUser()
  {
    
    $identity = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $email = $this->request->getPost('email');
    $additional_data = array(
      'first_name' => $this->request->getPost('first_name'),
      'last_name' => $this->request->getPost('last_name'),
    );
    $group = array('2'); //Group

    $this->ionAuth->register($identity, $password, $email, $additional_data, $group);

      return redirect()->to('/auth/login');
  }
  
    public function register(){
      return view('auth/register');
    }
}

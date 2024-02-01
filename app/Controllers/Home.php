<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\GetEvent;
use App\Models\Model;
use App\Libraries\Datum;

class Home extends BaseController
{
  var $datum;
  protected $db;
  function __construct()
  {
    $this->datum = new Datum();
    $this->db = \Config\Database::connect();
  }
  public function index()
  {
    $model = new GetEvent();
    $events = $model->getDataWithID();
    //$events = $model->findAll();
    return view('index', ['events' => $events]);
  }

  public function getEvents()
  {
    $model = new GetEvent();
    $events = $model->getDataWithID();

    $events_data = [];


    foreach ($events as $event) {
        $id = $event['id'];
        $title = $event['nazev_eventu'];
        $start = $event['zacatek_eventu'];
        $end = $event['konec_eventu'];
        $color = $event['color'];

        // Přidejte data události do pole
        $events_data[] = [
            'id' => $id,
            'title' => $title,
            'start' => $start.'00:00:00',
            'end' => $end.'00:00:00',
            'color' => $color
        ];
    }

    return json_encode($events_data);
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
      'user_id' => \App\Helpers\User::user()->id,

    ];


    $rozgahDatum = $this->request->getPost('rozgah_datum'); // Opravený název proměnné
    if ($rozgahDatum) {
      $datum = $this->datum->splitDate($rozgahDatum);
      $data['zacatek_eventu'] = $datum['zacatek_eventu'] ." " . $this->request->getPost('startTime');
      $data['konec_eventu'] = $datum['konec_eventu'] ." " . $this->request->getPost('endTime');
    }

    $builder = $this->db->table('eventy');
    $builder->insert($data);
      return redirect()->to('/');
  }


  public function profil()
  {
    $ionAuth = new \IonAuth\Libraries\IonAuth();
    $id = \App\Helpers\User::user()->id;
    $user_groups = $this->ionAuth->getUsersGroups($id)->getResult();
    $groups = array();
    foreach($user_groups as $group){
        if($group->id == 1 || $group->id == 2){
          continue;
        }
        $groups[] = $group;
    }

    $data['user_groups'] = $groups;
    return view('profil', $data);
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

      public function group(){
       return view('createGroup');
      }

    public function createGroup(){
      $idU = \App\Helpers\User::user()->id;

      $name = $this->request->getPost('group_name');
      $description = $this->request->getPost('description');
      $group = $this->ionAuth->createGroup($name, $description);

      if(!$group){
        return redirect()->to('/profil')->with('danger', 'Skupina již existuje');
      }else{
        $this->ionAuth->addToGroup($group, $idU);
        return redirect()->to('/profil');
      }

    }

    public function showGroup($id){
      $model = new Model();
      $data['group'] = $model->getGroupById($id);
      $data['people'] = $model->getUsers($id);
      return view('group', $data);
    }



    public function getEvent($id){
      $model = new Model();
      $event = $model->getEventById($id);
      $data = json_encode((array)$event);
      return $data;
    }

    public function getEventEdit($id){
      $model = new Model();
      $data['event'] = $model->getEventById($id);
      return view('eventEdit', $data);
    }

    public function editEvent($id){
      $data = $this->request->getPost();
      $model = new EventModel();

      $prep = [
        'nazev_eventu' => $data['name'],
        'zacatek_eventu' => $data['start'],
        'konec_eventu' => $data['end'],
        'color' =>$data['color'],
        'description' => $data['description'],
        'latitute' => $data['latitute'],
        'longtitute' => $data['longtitute']
      ];

      $model->update($id, $prep);
      return redirect()->to('/event/edit/'.$id);

    }

    public function addUserToGroup($id){
      $model = new Model();
      if($model->addUserToGroup($id, $this->request->getPost()['users'])){
        return redirect()->to('/group/'.$id);
      }
    }

    public function checkUser(){
      $username = $this->request->getPost("identity");

      $model = new Model();


      echo $model->checkUser($username) >= 1 ? json_encode(false) : json_encode(true);
    }


    public function registerEmail(){
      $email = $this->required->getPost("email");
      $rules = [
        'email' => "is_unique[users.email]",
      ];
      $data = array(
        'email' => $email,
      );
      $this->validatio->setRules($rules);
      $result = $this->validation->run($data);
      $result2 = json_encode($result);
      echo $result2;
    }

}

<?php

namespace App\Controllers;

use App\Helpers\User;
use App\Models\EventModel;
use App\Models\GetEvent;
use App\Models\Model;
use App\Models\UserModel;
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
  
  //metoda vykresli view s tabulkou uzivatelu a z databaze (modelu) vezme data vsech uzivatelu
  public function getUsers()
  {
    $model = new Model();

    $data['users']= $model->getUsersAll();
    return view('userList', $data);
  }

  public function getGroups()
  {
    $model = new Model();

    $data['groups'] = $model->getGroups();

    return view('groupList', $data);
  }

  public function delGroup($id)
  {
    $model = new Model();
    if($model->isInGroup(User::user()->id, $id))
    {
      return redirect()->to('/admin/groups')->with('flash-error', 'Nemůžeš odebrat sám sebe!');
    }else {
      $model->deleteGroupsUsersByGroupId($id);
      $model->deleteGroupById($id);

      return redirect()->to('/admin/groups')->with('flash-success', 'Skupina smazana!');
    }
  }

  public function delUser($id){
    $model = new Model();
    $model->deleteUserById($id);
    return redirect()->to('/admin/users/')->with('flash-success', 'Uživatel smazán!');
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

    public function removeFromGroup($groupId, $userId)
    {
      $model = new Model();

      if($userId == User::user()->id) {        
        return redirect()->to('/group/'.$groupId)->with('flash-error', 'Nemuze odebrat sam sebe!');
      }

      $model->removeUserFromGroup($groupId, $userId);

      
      return redirect()->to('/group/'.$groupId)->with('flash-success', 'Uspesne odebrano!');
    }

    public function getUser($id){
      $model = new Model();
      $data['user'] = $model->getUserById($id);
      return view('editUser', $data);

    }

    public function editUserById($id){
      $data = $this->request->getPost();
      $model = new UserModel();
      $userDB = $model->find($id);

      if(!empty($data['password'])){
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
      }
      
      $prep = [
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'phone' => $data['phone'],
        'password' => $password,
        'company' =>$data['company']
      ];
      $model->update($id, $prep);
      return redirect()->to('admin/users/edit/'.$id)->with('flash-success', 'Údaje úspěšně změněny');
    }

    public function showGroup($id){
      $model = new Model();
      $data['group'] = $model->getGroupById($id);
      $data['people'] = $model->getUsers($id);
      $data['users'] = $model->getUsersByGroupId($id);
      return view('group', $data);
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

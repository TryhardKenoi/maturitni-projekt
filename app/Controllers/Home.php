<?php

namespace App\Controllers;

use App\Helpers\User;
use App\Models\EventModel;
use App\Models\GetEvent;
use App\Models\Model;
use App\Models\UserModel;
use App\Libraries\Datum;
use App\Models\EventyGroupModel;
use App\Models\EventyUserModel;
use App\Models\GroupModel;
use DateTime;

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
    return view('index', 
      [
        'events' => $events,
        'eventsList' => $this->getEvents(),
      ]
    );
  }
  
  //metoda vykresli view s tabulkou uzivatelu a z databaze (modelu) vezme data vsech uzivatelu
  public function getUsers()
  {
    $model = new Model();

    $data['users']= $model->getUsersAll();
    return view('userList', $data);
  }

  public function getAllEvents(){
    $model = new EventModel();
    $data['event'] = $model->findAll();

    return view('eventList', $data);
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

  public function deleteEvent($id){
    $model = new EventModel();
    $model->deleteEventAndRelated($id);
    
    return redirect()->to('/')->with('flash-success', 'Event smazán!');
  }

  public function deleteEventAdmin($id){
    $model = new EventModel();
    $model->deleteEventAndRelated($id);

    return redirect()->to('/admin/events')->with('flash-success', 'Event smazán!');
    }

  public function getEvents()
  {
    $model = new GetEvent();
    $events = $model->getDataWithID();
    $events_data = [];

    foreach ($events as $event) {
      
        $id = $event->id;
        $title = $event->nazev_eventu;
        $color = $event->color;
        $start = $event->zacatek_eventu;
        $end = $event->konec_eventu;

        // Přidejte data události do pole
        $events_data[] = [
            'id' => $id,
            'title' => $title,
            'start'=> $start,
            'end'=> $end,
            'color' => $color,
            'allDay' => (strstr($start, "00:00:00"))?true:false
        ];

    }
    return json_encode($events_data);
  }

  public function addEvent()
  {
    $uModel = new UserModel();
    $gModel = new GroupModel();
    $data['people'] = $uModel->findAll();
    $data['groups'] = $gModel->findAll();
    return view('addEvent', $data);
  }

  public function create()
  {
    $euModel = new EventyUserModel();
    $egModel = new EventyGroupModel();
    $eModel = new EventModel();

    $userId = \App\Helpers\User::user()->id;
    //users a groups
    $userList = $this->request->getPost('users');
    $groupList = $this->request->getPost('groups');

    $data = [
      'nazev_eventu' => $this->request->getPost('nazev_eventu'),
      'zacatek_eventu' => null,
      'konec_eventu' => null,
      'color' => $this->request->getPost('color'),
      'creator_id' => $userId
    ]; 


    $rozgahDatum = $this->request->getPost('rozgah_datum'); // Opravený název proměnné
    if ($rozgahDatum) {
      $datum = $this->datum->splitDate($rozgahDatum);
      $data['zacatek_eventu'] = $datum['zacatek_eventu'] ." " . $this->request->getPost('startTime');
      $data['konec_eventu'] = $datum['konec_eventu'] ." " . $this->request->getPost('endTime');
    }

    $eModel->insert($data);
    $eventId = $eModel->getInsertID();

    if($userList != null) {
      foreach($userList as $id){
        $euModel->insert(['user_id' => $id, 'event_id'=>$eventId]);
      }
    }

    if($groupList != null) {
      foreach($groupList as $id){
        $egModel->insert(['group_id' => $id, 'event_id'=>$eventId]);
      }
    }

    return redirect()->to('/')->with('flash-success', 'Přidáno!');
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

  public function createUserAdmin()
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

      return redirect()->to('admin/users')->with('success', 'Uživatel vytvořen');
  }

  public function registerUser(){
    return view('registerAdmin');
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
      $this->ionAuth->updateGroup($group, $name, array(
        'owner_id' => $idU
      ));
      return redirect()->to('/profil');
    }

    return redirect()->to('/profil');
  }

  public function getEvent($id){
    $model = new Model();
    $event = $model->getEventById($id);
    $event->groups = $model->getGroupsByEventId($id);
    $event->users = $model->getUsersByEventId($id);
    $event->allDay = (strstr($event->zacatek_eventu, "00:00:00"))?true:false;
    $data = json_encode((array)$event);
    return $data;
  }

  public function getEventEdit($id){
    $model = new Model();
    $e = $model->getEventById($id);
    $data['event'] = $e;
    $data['users'] = $model->getUsersFromEventByEventId($id);
    $data['groups'] = $model->getGroupsFromEventByEventId($id);
    $data['people'] = $model->getUsersToAddFiltered($id);
    $data['roles'] = $model->getRolesToAddFiltered($id);
    return view('eventEdit', $data);
  }

  public function getEventEditAdmin($id){
    $model = new Model();
    $e = $model->getEventById($id);
    $data['event'] = $e;
    $data['users'] = $model->getUsersFromEventByEventId($id);
    $data['groups'] = $model->getGroupsFromEventByEventId($id);
    $data['people'] = $model->getUsersToAddFiltered($id);
    $data['roles'] = $model->getRolesToAddFiltered($id);

    return view('editEventAdmin', $data);
  }

  public function editEvent($eventId){
    $data = $this->request->getPost();
    $model = new EventModel();
    $euModel = new EventyUserModel();
    $egModel = new EventyGroupModel();

    $userList = $this->request->getPost('users');
    $groupList = $this->request->getPost('groups');

    $prep = [
      'nazev_eventu' => $data['name'],
      'zacatek_eventu' => $data['start'],
      'konec_eventu' => $data['end'],
      'color' =>$data['color'],
      'description' => $data['description'],
      'latitute' => $data['latitute'],
      'longtitute' => $data['longtitute']
    ];


    if($userList != null) {
      foreach($userList as $id){
        $euModel->insert(['user_id' => $id, 'event_id'=>$eventId]);
      }
    }

    if($groupList != null) {
      foreach($groupList as $id){
        $egModel->insert(['group_id' => $id, 'event_id'=>$eventId]);
      }
    }
    

    $model->update($eventId, $prep);
    return redirect()->to('/event/edit/'.$eventId)->with('flash-success', 'Změna úspěšná!');;

  }

  public function editEventBonge($eventId){
    $data = $this->request->getPost();
    $model = new EventModel();
    
    $euModel = new EventyUserModel();
    $egModel = new EventyGroupModel();

    
    $userList = $this->request->getPost('users');
    $groupList = $this->request->getPost('groups');

    $prep = [
      'nazev_eventu' => $data['name'],
      'zacatek_eventu' => $data['start'],
      'konec_eventu' => $data['end'],
      'color' =>$data['color'],
      'description' => $data['description'],
      'latitute' => $data['latitute'],
      'longtitute' => $data['longtitute']
    ];

    
    if($userList != null) {
      foreach($userList as $id){
        $euModel->insert(['user_id' => $id, 'event_id'=>$eventId]);
      }
    }

    if($groupList != null) {
      foreach($groupList as $id){
        $egModel->insert(['group_id' => $id, 'event_id'=>$eventId]);
      }
    }
    

    $model->update($eventId, $prep);
    return redirect()->to('/admin/event/edit/'.$eventId)->with('flash-success', 'Změna úspěšná!');
  }

  public function removeFromGroup($groupId, $userId)
  {
    $model = new Model();

    if($userId == User::user()->id) {        
      return redirect()->to('/admin/groups/edit/'.$groupId)->with('flash-error', 'Nemuze odebrat sam sebe!');
    }

    $model->removeUserFromGroup($groupId, $userId);

    
    return redirect()->to('/admin/groups/edit/'.$groupId)->with('Fsuccess', 'Uspesne odebrano!');
  }

  public function removeUserFromEvent($eventUserID, $eventId){
    $model = new Model();

    if($model->removeUserFromEvent($eventUserID)){
      return redirect()->to('/event/edit/'.$eventId)->with('flash-success', 'Úspěšně odebráno!');
    }else{
      return redirect()->to('/event/edit/'.$eventId)->with('flash-error', 'Odebrání neuspěšné!');
    }    
  }

  public function removeGroupFromEvent($eventGroupId, $eventId){
    $model = new Model();
    if($model->removeGroupFromEvent($eventGroupId)){
      return redirect()->to('/event/edit/'.$eventId)->with('flash-success', 'Úspěšně odebráno!');
    }else{
      return redirect()->to('/event/edit/'.$eventId)->with('flash-error', 'Odebrání neuspěšné!');
    }
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
    }else{
      $password = $userDB->password;
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

  public function addUserToGroupAdmin($id){
    $model = new Model();
    if($model->addUserToGroup($id, $this->request->getPost()['users'])){
      return redirect()->to('/admin/groups/edit/'.$id);
    }
  }

  public function changePassForm($id){
    $model = new Model();
    $data['user'] = $model->getUserById($id);
    return view('changePassword', $data);
  }

  public function changePassword($id){
    $data = $this->request->getPost();
    $model = new UserModel();
    $userDB = $model->find($id);

    if(!empty($data['password']) && password_verify($data['old-password'], $userDB->password)){
      $password = password_hash($data['password'], PASSWORD_DEFAULT);
      $prep = [
        'password' => $password,
      ];
      $model->update($id, $prep);
      return redirect()->to('profil/zmena-hesla/'.$id)->with('flash-success', 'Údaje úspěšně změněny');
    }else{
      $password = $userDB->password;
      return redirect()->to('profil/zmena-hesla/'.$id)->with('flash-error', 'dsjdkasjdkas úspěšně změněny');
    }  
  }

  public function editGroup($id){
    $model = new Model();
    $data['group'] = $model->getGroupById($id);
    $data['people'] = $model->getUsers($id);
    $data['users'] = $model->getUsersByGroupId($id);
    return view ('editgroup', $data);
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
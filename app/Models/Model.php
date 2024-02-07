<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use Config\Database;

class Model
{
    var $db;
    function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    function getGroupById($id) {
      $builder = $this->db->table('groups');
      $builder->select('*')
              ->where('id', $id);
      $result = $builder->get();
      return $result->getResult()[0];
    }


    function getEventById($id){
      $builder = $this->db->table('eventy');
      $builder->select('*')
              ->where('id', $id);
      $result = $builder->get();
    return $result->getResult()[0];
    }

    function getGroups()
    {
      $builder = $this->db->table('groups');
      $builder->select('*');
      $result = $builder->get();
      return $result->getResult();
    }

    function removeUserFromGroup($groupId, $userId)
    {
      $builder = $this->db->table('users_groups');

      $builder->where('group_id', $groupId);
      $builder->where('user_id', $userId);
      $builder->delete();

      return true;
    }

    function deleteGroupsUsersByGroupId($id)
    {
      $builder = $this->db->table('users_groups');

      $builder->where('group_id', $id);
      $builder->delete();



      return true;
    }
    
    function deleteGroupById($groupId)
    {
      $builder = $this->db->table('groups');

      $builder->where('id', $groupId);
      $builder->delete();
      return true;
    }

    function isInGroup($userId, $groupId)
    {
      $builder = $this->db->table('users_groups');
      $builder->select('users.id,users.first_name,users.last_name')
              ->join('users', 'users.id=users_groups.user_id', 'left')
              ->where('users_groups.group_id', $groupId)
              ->where('users.id', $userId);
      $result = $builder->get()->getResult();

      return count($result) == 1 ? true : false;
    }

    function deleteUserById($id){
      $builder = $this->db->table('users');

      $builder->where('id', $id);
      $builder->delete();

      return true;
    }

    function getUsersAll()
    {
      $sql = "SELECT u.id, u.first_name, u.last_name FROM users AS u";

      return $this->db->query($sql)->getResult();
    }

    function getUsersByGroupId($id)
    {
      $builder = $this->db->table('users_groups');
      $builder->select('users.id,users.first_name,users.last_name')
              ->join('users', 'users.id=users_groups.user_id', 'left')
              ->where('users_groups.group_id', $id)
              ->orderBy('users.id');
      $result = $builder->get()->getResult();
      return $result;
    }



    function getUsers($id){
      /*
      $builder = $this->db->table('users');
      $builder->select('id, first_name, last_name');
      *
      return $builder->get()->getResult();
      */

      $sql = "SELECT u.id, u.first_name, u.last_name FROM users AS u
              LEFT JOIN users_groups AS ug ON ug.user_id = u.id and ug.group_id = ".$id."
              where ug.id is null
              group by u.id;";

      return $this->db->query($sql)->getResult();
    }

    function addUserToGroup($id, $data){
      foreach($data as $d){
        $o = [
          'user_id' => $d,
          'group_id' => $id
        ];
        $this->db->table('users_groups')->insert($o);
      }
      return true;
    }

    function getUserById($id){
      $builder = $this->db->table('users');
      $builder->select('*');
      $builder->where('users.id',$id);
      $result = $builder->get()->getResult()[0];
      return $result;
              
    }

    function checkUser($email){
      $builder = $this->db->table('users');
      $builder->select('count(id)')
              ->where('email', $email);
      $result = $builder->get()[0];
      return $result;
    }

  function isAdminByUserId($id) {

    /*
    $pQuery = $this->db->prepare(function($db) {
      $sql = "SELECT * FROM users_groups AS ug 
      LEFT JOIN groups AS g ON g.id = ug.group_id
      WHERE ug.user_id = ? AND g.name = ?
      ";

      return (new Query($db))->setQuery($sql);
    });

    $results = $pQuery->execute($id, 'admin');
    */

    $builder = $this->db->table('users_groups');
    $builder->select('*')
            ->join('groups', 'groups.id=users_groups.group_id', 'left')
            ->where('users_groups.user_id', $id)
            ->where('groups.name', 'admin');
    return $builder->get()->getResult();
  }
}

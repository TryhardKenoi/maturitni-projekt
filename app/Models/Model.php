<?php

namespace App\Models;


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

      return [];
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

    function checkUser($email){
      $builder = $this->db->table('users');
      $builder->select('count(id)')
              ->where('email', $email);
      $result = $builder->get()[0];
      return $result;
    }
}

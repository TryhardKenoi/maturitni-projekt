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

}

<?php

namespace App\Models;

use CodeIgniter\Model;

class GetEvent extends \CodeIgniter\Model
{
    protected $table = 'eventy';
    protected $id = '$id';

    public function getDataWithID(){
      if(\App\Helpers\User::isLoggedIn()){
        $userID = \App\Helpers\User::user()->id;

        return $this->where('user_id', $userID)->findAll();
      }else{
        return [];
        }

    }
}

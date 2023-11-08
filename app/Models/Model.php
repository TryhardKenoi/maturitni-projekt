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

   

}

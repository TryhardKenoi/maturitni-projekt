<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends \CodeIgniter\Model
{

    protected $table = 'groups';
    protected $id = '$id';
    protected $allowedFields = [
        'name'
    ];
    protected $returnType = "object";

}

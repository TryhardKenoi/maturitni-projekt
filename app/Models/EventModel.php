<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends \CodeIgniter\Model
{

    protected $table = 'eventy';
    protected $id = '$id';
    protected $allowedFields = [
        'nazev_eventu',
        'zacatek_eventu',
        'konec_eventu',
        'color',
        'description',
        'latitute',
        'longtitute'
    ];
    protected $returnType = "object";

}

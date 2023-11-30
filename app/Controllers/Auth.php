<?php

namespace App\Controllers;

class Auth extends \IonAuth\Controllers\Auth
{
  public function __construct()
   {
       parent::__construct();
       // Volání konstruktoru původního controlleru, abyste zachovali jeho funkcionalitu
   }


    /**
     * If you want to customize the views,
     *  - copy the ion-auth/Views/auth folder to your Views folder,
     *  - remove comment
     */
     protected $viewsFolder = 'auth';
}

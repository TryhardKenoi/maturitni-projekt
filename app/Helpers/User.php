<?php

namespace App\Helpers;


class User
{

    public static function isLoggedIn() {
        $ionAuth = new \IonAuth\Libraries\IonAuth();

        return $ionAuth->loggedIn();
    }

    public static function user() {
      $ionAuth = new \IonAuth\Libraries\IonAuth();

      return $ionAuth->user()->row();
    }



}

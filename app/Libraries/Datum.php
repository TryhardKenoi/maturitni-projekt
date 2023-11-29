<?php
  namespace App\Libraries;

  class Datum{
    function __construct(){

    }
/** Metoda pro rozdělení datumu do dvou proměnných
$date = string = např. 2022-10-10 to 2023-10-10
 **/
      function splitDate($date){
        $rozgah = explode(" to ", $date); // Rozdělení pole na začátek a konec rozsahu
        $data['zacatek_eventu'] = date('Y-m-d', strtotime($rozgah[0])); // Převod začátku rozsahu do formátu pro databázi DATE
        $data['konec_eventu'] = date('Y-m-d', strtotime($rozgah[1])); // Převod konce rozsahu do formátu pro databázi DATE

        return $data;
      }
  }
 ?>

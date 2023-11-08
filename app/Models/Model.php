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


    function getDVDs()
    {

        $builder = $this->db->table('organizace');
        $builder->select('idorganizace, nazev');

        $data = $builder->get()->getResult();
        return $data;
    }

    function neco($id) {
        $builder = $this->db->table('organizace');
        $builder->select('*')
            ->join('programorganizace', 'programorganizace.organizace_idorganizace = organizace.idorganizace', 'inner')
            ->join('program', 'program.idprogram = programorganizace.program_idprogram', 'inner')
            ->where('organizace.idorganizace', $id);

        $result = $builder->get();
        return $result->getResult();
    }

    function getZeme(){
            $builder = $this->db->table('zeme');
            $builder->select('*');
            $data = $builder->get()->getResult();
            return $data;
    }

    function getVesmzeme($id) {
        $builder = $this->db->table('vesmstanice');
        $builder->select('*, zeme.idzeme')
            ->join('zeme', 'zeme.idzeme = vesmstanice.zeme_idzeme', 'inner')
            ->where('vesmstanice.zeme_idzeme', $id);

        $result = $builder->get();
        return $result->getResult();
    }

    public function getOrganizace()
    {
            $builder = $this->db->table('organizace');
            $builder->select('idorganizace, nazev');

            $data = $builder->get()->getResult();
            return $data;
    }

    public function getRakety(){
        $builder = $this->db->table('raketa');
        $builder->select('*');
        $data = $builder->get()->getResult();
        return $data;
    }

    function getKosByRak($id) {
        $builder = $this->db->table('raketa');
        $builder->select('*')
            ->join('posadka', 'posadka.idposadka = raketa.idraketa', 'inner')
            ->join('kosmonaut', 'kosmonaut.posadka_idposadka = posadka.idposadka', 'inner')
            ->where('raketa.idraketa', $id);

        $result = $builder->get();
        return $result->getResult();
    }

    function getPagination(){
      $builder = $this->db->table('mise');
      $builder->select('*');

      $data = $builder->get()->getResult();
      return $data;
    }

}

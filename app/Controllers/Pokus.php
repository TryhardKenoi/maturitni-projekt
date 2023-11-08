<?php

namespace App\Controllers;


use App\Models\Model;
use App\Models\Page;

class Pokus extends BaseController
{
    public function pokus()
    {
        $model = new Model();
        $data['data'] = $model->getRakety();
        echo view('raketa', $data);
    }

    public function cards($id = null) {
        $model = new Model();
        $data['id'] = $id;
        $data['data'] = $model->neco($id);
        echo view('program', $data);
    }

    public function posadka($id = null){
        $model = new Model();
        $data['id'] = $id;
        $data['data'] = $model->neco($id);
        echo view('kosmonaut', $data);
    }

    public function zeme(){
        $model = new Model();
        $data['data'] = $model->getZeme();
        echo view('zeme', $data);
    }

    public function vesmzeme($id = null){
        $model = new Model();
        $data['id'] = $id;
        $data['data'] = $model->getVesmzeme($id);
        echo view('vesmzeme', $data);
    }

    public function organizace()
    {
        $model = new Model();
        $data['data'] = $model->getOrganizace();
        echo view('organizace', $data);
    }

    public function default(){
        echo view('default');
    }

    public function getKosByRak($id = null){
        $model = new Model();
        $data['id'] = $id;
        $data['data'] = $model->getKosByRak($id);
        echo view('raketa2', $data);
    }

    public function useless(){
        echo view('useless');
    }

    public function aer(){
      helper('form');


      return view('aer');
    }

      public function pagination(){
        $pager = \Config\Services::pager();
        $model = new Page();
        $data['records'] = $model->paginate(20);
        $data['pager'] = $model->pager;
        $data['title'] = "Pagination";
        echo view('pagination', $data);
      }

}

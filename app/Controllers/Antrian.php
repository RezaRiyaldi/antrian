<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Database;

class Antrian extends BaseController {
    private $db = "";

    public function __construct()
    {
        $this->db = Database::connect()->table('antrian');
    }

    public function index()
    {
        $this->db->join('loket', 'loket.id_loket = antrian.loket_id');
        $getAntrian = $this->db->get()->getResult();

        var_dump($getAntrian); die;
        
        $data = [
            'title' => 'Antrian',
            
        ];

        return view('antrian/v_antrian', $data);
    }
}
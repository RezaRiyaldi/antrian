<?php

namespace App\Controllers;

use Config\Database;

class Home extends BaseController
{
    public function index()
    {
        $loket = Database::connect()->table('loket')
            ->join('pelayanan', 'pelayanan.id_pelayanan = loket.pelayanan_id')
            ->get()->getResultArray();

        $data = [
            'title' => "Home",
            'loket' => $loket
        ];

        return view('home', $data);
    }
}

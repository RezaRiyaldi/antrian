<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AntrianModel;
use App\Models\LoketModel;
use App\Models\PelayananModel;
use Config\Database;
use DateTime;

class Antrian extends BaseController
{
    private $db = "";

    public function __construct()
    {
        $this->db = Database::connect();
        $this->antrian = new AntrianModel();
        $this->pelayanan = new PelayananModel();
        $this->loket = new LoketModel();
    }

    public function index()
    {
        $getLoket = $this->db->table('loket')
            ->join('pelayanan', 'pelayanan.id_pelayanan = loket.pelayanan_id')
            ->get()->getResultArray();

        // dd($getLoket);

        $data = [
            'title' => 'Antrian',
            'lokets' => $getLoket
        ];

        return view('antrian/v_antrian', $data);
    }

    public function ambil_antrian($id_pelayanan, $id_loket)
    {
        $no_antrian = 1;
        // $dateTime = 
        // $hari_ini = 
        $getPelayanan = $this->pelayanan->find($id_pelayanan);
        $getLoket = $this->loket->find($id_loket);

        $builder = $this->db->table('antrian');
        $getAntrian = $builder->where('created_at', date('Y-m-d'))
            // ->where('kode_antrian', $getPelayanan['kode_pelayanan'])
            // ->join('pelayanan', 'antrian.pelayanan_id = pelayanan.id_pelayanan')
            ->get()->getLastRow();


        // dd($getAntrian);
        if ($getAntrian != NULL) {
            $no_antrian = $getAntrian->no_antrian + 1;
        }

        $data_antrian = [
            'no_antrian' => $no_antrian,
            'kode_antrian' => strtoupper($getPelayanan['kode_pelayanan'] . '-' . $no_antrian),
            'status' => 0,
            'created_at' => date('Y-m-d'),
            'pelayanan_id' => $id_pelayanan,
            'loket_id' => $id_loket
        ];

        // dd($data_antrian);

        $builder->insert($data_antrian);

        session()->setFlashdata('success', 'Berhasil mengambil antrian. No antrian anda adalah <span class="fw-bold">' . $data_antrian['kode_antrian'] . "</span>");
        session()->set('no_antrian', $data_antrian['kode_antrian']);
        return redirect('/');
    }

    public function panggil($id_antrian)
    {
        $antrian = Database::connect()->table('antrian');
        $data = [
            'status' => 1,
            'waktu_panggil' => date('Y-m-d H:i:s')
        ];

        $antrian->update($data, ['id_antrian' => $id_antrian]);
        session()->setFlashdata('success', 'Antrian dengan ' . $antrian->where('id_antrian', $id_antrian)->get()->getRowArray()['kode_antrian'] . ' sedang dalam proses');

        return redirect()->back();
    }

    public function selesai($id_antrian)
    {
        $antrian = Database::connect()->table('antrian');
        $data = [
            'status' => 2,
            'waktu_selesai' => date('Y-m-d H:i:s')
        ];

        $antrian->update($data, ['id_antrian' => $id_antrian]);
        session()->setFlashdata('success', 'Antrian dengan ' . $antrian->where('id_antrian', $id_antrian)->get()->getRowArray()['kode_antrian'] . ' telah selesai');
        session()->remove('no_antrian');

        return redirect()->back();
    }

    public function selesai_paksa()
    {
        session()->setFlashdata('success', 'Silahkan mengambil no antrian');
        session()->remove('no_antrian');

        return redirect()->back();
    }
}

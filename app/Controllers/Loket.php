<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Database;

class Loket extends BaseController
{
    private $db = "";

    public function __construct()
    {
        $this->db = Database::connect()->table('loket');
    }

    public function index()
    {
        // $this->db->join('pelayanan', 'pelayanan.id_pelayanan = loket.pelayanan_id');
        $getLoket = $this->db->join('pelayanan', 'pelayanan.id_pelayanan = loket.pelayanan_id')->get()->getResultArray();

        // var_dump($getLoket); die;
        $data = [
            'title' => 'Loket',
            'loket' => $getLoket
        ];

        return view('loket/v_loket', $data);
    }

    public function detail_loket($id_loket, $id_pelayanan)
    {
        $tableAntrian = Database::connect()->table('antrian')
            ->join('loket', 'loket.id_loket = antrian.loket_id', 'left')
            ->where('id_loket', $id_loket)
            ->where('antrian.pelayanan_id', $id_pelayanan)
            ->where('created_at', date('Y-m-d'))
            ->orderBy('status', 'asc');

        $antrian = $tableAntrian->get()->getResultArray();

        $antrianNow = $tableAntrian->where('status', 1)
            ->where('loket_id', $id_loket)
            ->where('pelayanan_id', $id_pelayanan)
            ->where('created_at', date('Y-m-d'))
            ->get()->getFirstRow();

        $loket = Database::connect()->table('loket')
            ->where('id_loket', $id_loket)
            ->get()->getRowArray();

        $data = [
            'title' => 'List Loket',
            'antrian' => $antrian,
            'antrianNow' => $antrianNow,
            'loket' => $loket
        ];

        return view('loket/v_detail_loket', $data);
    }

    public function tambah_loket()
    {
        // $getLoket = $this->db->join('pelayanan', 'pelayanan.id_pelayanan = loket.pelayanan_id')->get()->getResultArray();        
        // $getPelayanan = Database::connect()->table('pelayanan')->get()->getResultArray();
        $getPelayanan = Database::connect()->table('pelayanan')
        ->join('loket', 'loket.pelayanan_id = pelayanan.id_pelayanan', 'left')
        ->where('id_loket', null)
        ->get()->getResultArray();

        // dd($getPelayanan);

        $data = [
            'title' => 'Tambah Loket',
            // 'loket' => $getLoket,
            'pelayanan' => $getPelayanan,
        ];

        return view('loket/v_tambah_loket', $data);
    }

    public function proses_tambah_loket()
    {
        if (!$this->validate([
            'nama_loket' => [
                'rules' => ['required', 'is_unique[loket.nama_loket]'],
                'errors' => [
                    'required' => 'Nama Loket wajib diisi.',
                    'is_unique' => 'Nama Loket sudah dipakai, mohon pakai nama lain.',
                ],
            ],
            'pelayanan_id' => [
                'rules' => ['required'],
                'errors' => [
                    'required' => 'Nama Pelayanan wajib diisi!',
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $data_loket = [
            'nama_loket' => ucwords(strtolower($this->request->getPost('nama_loket'))),
            'pelayanan_id' => $this->request->getPost('pelayanan_id')
        ];

        $this->db->insert($data_loket);

        session()->setFlashdata('success', 'Berhasil menambahkan loket baru.');
        return redirect('loket');
    }

    public function edit_loket($id_loket)
    {
        $getLoket = $this->db->join('pelayanan', 'pelayanan.id_pelayanan = loket.pelayanan_id')->getWhere(['id_loket' => $id_loket])->getRow();
        $getPelayanan = Database::connect()->table('pelayanan')->get()->getResult();

        // var_dump($getPelayanan); die;

        $data = [
            'title' => 'Ubah Loket',
            'loket' => $getLoket,
            'pelayanan' => $getPelayanan
        ];

        return view('loket/v_ubah_loket', $data);
    }

    public function proses_edit_loket($id_loket)
    {
        $type_message = 'error';
        $message = '';
        $success = FALSE;
        if (!$this->validate([
            'nama_loket' => [
                'rules' => ['required'],
                'errors' => [
                    'required' => 'Nama Loket wajib diisi.'
                ],
            ],
            'pelayanan_id' => [
                'rules' => ['required'],
                'errors' => [
                    'required' => 'Nama Pelayanan wajib diisi!',
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $data_loket = [
            'nama_loket' => ucwords(strtolower($this->request->getPost('nama_loket'))),
            'pelayanan_id' => $this->request->getPost('pelayanan_id')
        ];

        $getLoket = $this->db->getWhere(['id_loket' => $id_loket, 'nama_loket' => $data_loket['nama_loket']])->getRow();

        // var_dump($getLoket); die;

        if ($getLoket) {
            $this->db->update($data_loket, ['id_loket' => $id_loket]);
            $type_message = 'success';
            $message = 'Berhasil merubah loket';
            $success = TRUE;
        } else {
            $message = 'Gagal merubah loket, kode loket sudah digunakan';
        }

        session()->setFlashdata($type_message, $message);

        if ($success) {
            return redirect('loket');
        } else {
            return redirect()->back();
        }
    }

    public function delete_loket($id_loket)
    {
        $this->db->delete(['id_loket' => $id_loket]);

        session()->setFlashdata('success', 'Berhasil menghapus loket');

        return redirect()->back();
    }
}

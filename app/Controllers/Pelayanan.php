<?php

namespace app\Controllers;

use App\Controllers\BaseController;
use App\Models\PelayananModel;
use Config\Database;
use Config\Services;

class Pelayanan extends BaseController
{
    private $pelayanan = "";
    private $db = "";

    public function __construct()
    {
        $this->validation = Services::validation();
        $this->pelayanan = new PelayananModel();
        $this->db = Database::connect()->table('pelayanan');
    }
    public function index()
    {
        $getPelayanan = $this->db->join('loket', 'loket.pelayanan_id = pelayanan.id_pelayanan', 'left')->get()->getResultArray();

        // dd($getPelayanan);
        // $getPelayanan = $this->pelayanan->findAll();

        $data = [
            'title' => 'Pelayanan',
            'pelayanan' => $getPelayanan
        ];

        return view('pelayanan/v_pelayanan', $data);
    }

    public function tambah_pelayanan()
    {
        $data = [
            'title' => 'Tambah Pelayanan'
        ];

        return view('pelayanan/v_tambah_pelayanan', $data);
    }

    public function proses_tambah_pelayanan()
    {
        if (!$this->validate([
            'kode_pelayanan' => [
                'rules' => ['required', 'is_unique[pelayanan.kode_pelayanan]'],
                'errors' => [
                    'required' => 'Kode Pelayanan wajib diisi.',
                    'is_unique' => 'Kode Pelayanan sudah dipakai, mohon pakai kode lain.',
                ],
            ],
            'nama_pelayanan' => [
                'rules' => ['min_length[4]', 'required'],
                'errors' => [
                    'required' => 'Nama Pelayanan wajib diisi!',
                    'min_length' => 'Nama Pelayananan minimal 4 karakter!'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->pelayanan->insert([
            'kode_pelayanan' => strtoupper($this->request->getPost('kode_pelayanan')),
            'nama_pelayanan' => ucwords(strtolower($this->request->getPost('nama_pelayanan')))
        ]);

        session()->setFlashdata('success', 'Berhasil menambahkan pelayanan baru.');
        return redirect()->to('pelayanan');
    }

    public function edit_pelayanan($id_pelayanan)
    {
        $pelayanan = $this->db->getWhere(['id_pelayanan' => $id_pelayanan])->getRow();

        $data = [
            'title' => 'Ubah Pelayanan',
            'pelayanan' => $pelayanan
        ];

        return view('pelayanan/v_ubah_pelayanan', $data);
    }

    public function proses_edit_pelayanan($id_pelayanan)
    {
        $type_message = 'error';
        $message = '';
        $success = FALSE;
        if (!$this->validate([
            'kode_pelayanan' => [
                'rules' => ['required'],
                'errors' => [
                    'required' => 'Kode Pelayanan wajib diisi.',
                ],
            ],
            'nama_pelayanan' => [
                'rules' => ['min_length[4]', 'required'],
                'errors' => [
                    'required' => 'Nama Pelayanan wajib diisi!',
                    'min_length' => 'Nama Pelayananan minimal 4 karakter!'
                ]
            ]
        ])) {
            session()->setFlashdata($type_message, $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $data = [
            'kode_pelayanan' => strtoupper($this->request->getPost('kode_pelayanan')),
            'nama_pelayanan' => ucwords(strtolower($this->request->getPost('nama_pelayanan')))
        ];

        // $getPelayanan = $this->db->getWhere(['id_pelayanan' => $id_pelayanan, 'kode_pelayanan' => $data['kode_pelayanan']])->getRow();
        $getPelayanan = Database::connect()->table('pelayanan')
        ->where('id_pelayanan', $id_pelayanan)
        ->get()->getRowArray();

        if (count($getPelayanan) > 0) {
            $this->db->update($data, ['id_pelayanan' => $id_pelayanan]);
            $type_message = 'success';
            $message = 'Berhasil merubah pelayanan';
            $success = TRUE;
        } else {
            $message = 'Gagal merubah pelayanan, kode pelayanan sudah digunakan';
        }

        session()->setFlashdata($type_message, $message);

        if ($success) {
            return redirect('pelayanan');
        } else {
            return redirect()->back();
        }
    }

    public function delete_pelayanan($id_pelayanan)
    {
        $this->db->delete(['id_pelayanan' => $id_pelayanan]);

        session()->setFlashdata('success', 'Berhasil menghapus pelayanan');

        return redirect()->back();
    }
}

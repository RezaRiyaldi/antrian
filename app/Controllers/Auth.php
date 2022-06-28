<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use Config\Database;

class Auth extends BaseController
{

    private $admin = "";
    private $db = "";

    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->db = Database::connect()->table('admin');
    }

    public function login()
    {
        $data = [
            'title' => 'Login'
        ];

        return view('auth/v_login', $data);
    }

    public function process_login()
    {
        $type_message = 'error';
        $message = '';
        $success = FALSE;

        if (!$this->validate([
            'username' => [
                'rules' => ['required'],
                'errors' => [
                    'required' => 'Username wajib diisi untuk proses login'
                ]
            ],
            'password' => [
                'rules' => ['required'],
                'errors' => [
                    'required' => 'Password wajib diisi untuk proses login'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $this->db->getWhere(['username' => $username])->getRow();

        if ($admin) {
            if (password_verify($password, $admin->password)) {
                $data_user = [
                    'username' => $admin->username,
                    'nama_lengkap' => $admin->nama_lengkap,
                    'logged_in' => TRUE
                ];

                session()->set($data_user);
                $type_message = 'success';
                $message = 'Berhasil login, selamat datang ' . $data_user['nama_lengkap'];
                $success = TRUE;
            } else {
                $message = 'Password salah';
            }
        } else {
            $message = 'Akun tidak ditemukan!';
        }

        session()->setFlashdata($type_message, $message);

        if ($success) {
            return redirect('/');
        }
        return redirect()->back();
    }

    public function register()
    {
        $data = [
            'title' => 'Register'
        ];

        return view('auth/v_register', $data);
    }

    public function process_register()
    {
        $type_message = 'error';
        $message = '';

        if (!$this->validate([
            'username' => [
                'rules' => ['required', 'min_length[4]', 'is_unique[admin.username]'],
                'errors' => [
                    'required' => 'Username wajib diisi untuk proses login',
                    'min_length' => 'Username minimal 4 karakter',
                    'is_unique' => 'Username sudah terdaftar!'
                ]
            ],
            'nama_lengkap' => [
                'rules' => ['required'],
                'errors' => [
                    'required' => 'Nama Lengkap wajib diisi untuk proses login'
                ]
            ],
            'password' => [
                'rules' => ['required', 'min_length[4]'],
                'errors' => [
                    'required' => 'Password wajib diisi untuk proses login',
                    'min_length' => 'Password minimal 4 karakter'
                ]
            ],
            'cpassword' => [
                'rules' => ['matches[password]'],
                'errors' => [
                    'matches' => 'Konfirmasi password harus sama dengan password'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $data_admin = [
            'username' => strtolower($this->request->getPost('username')),
            'nama_lengkap' => ucwords(strtolower($this->request->getPost('nama_lengkap'))),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $this->db->insert($data_admin);

        session()->setFlashdata('success', "Berhasil mendaftar, silahkan login");
        return redirect('admin/login');
    }

    public function logout()
    {
        $data_user = [
            'username', 'nama_lengkap'
        ];

        session()->remove($data_user);
        session()->set(['logged_in' => FALSE]);
        session()->setFlashdata('success', 'Berhasil logout, semoga harimu menyenangkan!');

        return redirect()->back();
    }
}

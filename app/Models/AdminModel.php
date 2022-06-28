<?php

namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model {
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $useAutoIncrement = TRUE;
    protected $allowedFields = ['username', 'password', 'nama_lengkap'];
}